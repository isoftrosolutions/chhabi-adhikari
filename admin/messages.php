<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();
require_once __DIR__ . '/../vendor/mail.php';

$db = getDB(); 
$action = $_GET['action'] ?? 'list'; 
$id = (int)($_GET['id'] ?? 0);
$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'reply' && $id) {
    $reply = trim($_POST['reply_text'] ?? '');
    if (empty($reply)) {
        $error = 'Reply message cannot be empty.';
    } else {
        $db->prepare("INSERT INTO contact_replies (message_id, reply_text) VALUES (?, ?)")->execute([$id, $reply]);
        $db->prepare("UPDATE contact_messages SET replied_at = NOW() WHERE id = ?")->execute([$id]);
        
        $stmt = $db->prepare("SELECT * FROM contact_messages WHERE id = ?");
        $stmt->execute([$id]);
        $messageData = $stmt->fetch();
        
        if ($messageData) {
            $sent = sendReplyEmail($messageData, $reply);
            if ($sent) {
                $msg = 'Reply sent and delivered to ' . htmlspecialchars($messageData['email']);
            } else {
                $msg = 'Reply saved (email delivery failed - check SMTP settings).';
            }
        }
    }
}

if ($action === 'view' && $id) {
    $db->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?")->execute([$id]);
}

if ($action === 'mark-read' && $id) {
    $db->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?")->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/messages.php');
    exit;
}

if ($action === 'mark-unread' && $id) {
    $db->prepare("UPDATE contact_messages SET is_read = 0 WHERE id = ?")->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/messages.php');
    exit;
}

if ($action === 'mark-all') {
    $db->exec("UPDATE contact_messages SET is_read = 1");
    header('Location: ' . BASE_URL . '/admin/messages.php?msg=all-read');
    exit;
}

if ($action === 'clear') {
    $db->exec("DELETE FROM contact_messages");
    $db->exec("DELETE FROM contact_replies");
    header('Location: ' . BASE_URL . '/admin/messages.php?msg=cleared');
    exit;
}

$message = null;
$replies = [];
if ($action === 'view' && $id) {
    $stmt = $db->prepare("SELECT * FROM contact_messages WHERE id = ?");
    $stmt->execute([$id]);
    $message = $stmt->fetch();
    if ($message) {
        $replies = $db->prepare("SELECT * FROM contact_replies WHERE message_id = ? ORDER BY created_at ASC")->execute([$id])->fetchAll();
    }
}

require_once __DIR__ . '/includes/layout.php';
adminHeader('Messages', 'messages');

if (isset($_GET['msg']) && $_GET['msg'] === 'all-read'): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> All messages marked as read.</div>
<?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'cleared'): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> All messages cleared.</div>
<?php endif; ?>

<?php if ($msg): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= h($msg) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= h($error) ?></div>
<?php endif; ?>

<?php if ($action === 'view' && $message): ?>
<div class="adm-card">
    <div class="adm-card-head">
        <h2>Message Details</h2>
        <a href="<?= BASE_URL ?>/admin/messages.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div style="display: grid; gap: 20px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>From</label>
                <div style="padding: 12px 13px; background: #f8fafc; border: 1.5px solid var(--border); border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-user" style="color: var(--muted); margin-right: 8px;"></i> <?= h($message['name']) ?>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <div style="padding: 12px 13px; background: #f8fafc; border: 1.5px solid var(--border); border-radius: 8px;">
                    <i class="fas fa-envelope" style="color: var(--muted); margin-right: 8px;"></i> 
                    <a href="mailto:<?= h($message['email']) ?>" style="color: var(--nav); text-decoration: none;"><?= h($message['email']) ?></a>
                </div>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Received</label>
                <div style="padding: 12px 13px; background: #f8fafc; border: 1.5px solid var(--border); border-radius: 8px; font-size: 0.88rem; color: var(--muted);">
                    <i class="fas fa-clock" style="margin-right: 8px;"></i> <?= date('M j, Y \a\t g:i A', strtotime($message['created_at'])) ?>
                </div>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div style="padding: 12px 13px; background: #f8fafc; border: 1.5px solid var(--border); border-radius: 8px;">
                    <?php if ($message['replied_at']): ?>
                        <span class="badge badge-green"><i class="fas fa-check"></i> Replied</span>
                        <span style="font-size: 0.78rem; color: var(--muted); margin-left: 8px;"><?= date('M j, Y', strtotime($message['replied_at'])) ?></span>
                    <?php elseif ($message['is_read']): ?>
                        <span class="badge badge-blue"><i class="fas fa-check"></i> Read</span>
                    <?php else: ?>
                        <span class="badge badge-gold"><i class="fas fa-star"></i> New</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Original Message</label>
            <div style="padding: 20px; background: #fff; border: 1.5px solid var(--border); border-radius: 8px; line-height: 1.7; white-space: pre-wrap;"><?= h($message['message']) ?></div>
        </div>
        
        <?php if (!empty($replies)): ?>
        <div style="border-top: 2px solid var(--border); padding-top: 24px;">
            <h3 style="font-size: 0.9rem; color: var(--muted); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 1px;">
                <i class="fas fa-reply"></i> Replies
            </h3>
            <div style="display: grid; gap: 16px;">
                <?php foreach ($replies as $reply): ?>
                <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 12px; padding: 16px 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.8rem;">
                                <?= strtoupper(substr($reply['admin_name'], 0, 1)) ?>
                            </div>
                            <strong style="color: var(--nav);"><?= h($reply['admin_name']) ?></strong>
                        </div>
                        <span style="font-size: 0.78rem; color: var(--muted);"><?= date('M j, Y \a\t g:i A', strtotime($reply['created_at'])) ?></span>
                    </div>
                    <div style="line-height: 1.7; white-space: pre-wrap; color: var(--text);"><?= h($reply['reply_text']) ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div style="border-top: 2px solid var(--border); padding-top: 24px;">
            <h3 style="font-size: 0.9rem; color: var(--muted); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 1px;">
                <i class="fas fa-paper-plane"></i> Send Reply
            </h3>
            <form method="POST" action="?action=reply&id=<?= $message['id'] ?>">
                <div class="form-group">
                    <label>Your Reply to <?= h($message['name']) ?></label>
                    <textarea name="reply_text" rows="6" required placeholder="Type your reply here..."><?= h($_POST['reply_text'] ?? '') ?></textarea>
                </div>
                <div class="form-actions" style="margin-top: 16px;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Reply</button>
                    <a href="mailto:<?= h($message['email']) ?>?subject=Re: D-School System Inquiry" class="btn btn-outline"><i class="fas fa-external-link-alt"></i> Open Email Client</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php else:
    $messages = $db->query("SELECT * FROM contact_messages ORDER BY is_read ASC, created_at DESC")->fetchAll();
    $unread = count(array_filter($messages, fn($m) => !$m['is_read']));
    $replied = count(array_filter($messages, fn($m) => $m['replied_at']));
?>
<div class="adm-card">
    <div class="adm-card-head">
        <h2>Contact Messages 
            <?php if ($unread > 0): ?><span class="badge badge-red" style="margin-left: 8px;"><?= $unread ?> unread</span><?php endif; ?>
        </h2>
        <div style="display: flex; gap: 8px;">
            <?php if ($unread > 0): ?>
                <a href="?action=mark-all" class="btn btn-outline btn-sm"><i class="fas fa-check-double"></i> Mark All Read</a>
            <?php endif; ?>
            <?php if (count($messages) > 0): ?>
                <a href="?action=clear" class="btn btn-danger btn-sm" data-confirm="Clear all messages? This cannot be undone."><i class="fas fa-trash-alt"></i> Clear All</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if (empty($messages)): ?>
        <div style="text-align: center; padding: 60px 20px; color: var(--muted);">
            <i class="fas fa-inbox" style="font-size: 48px; opacity: 0.3; margin-bottom: 16px;"></i>
            <p style="font-size: 1rem;">No messages yet</p>
            <p style="font-size: 0.85rem; margin-top: 8px;">Messages from the contact form will appear here.</p>
        </div>
    <?php else: ?>
    <table class="adm-table">
        <thead><tr><th>Name</th><th>Email</th><th>Preview</th><th>Received</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            <?php foreach ($messages as $m): 
                $preview = mb_strlen($m['message']) > 60 ? mb_substr($m['message'], 0, 60) . '...' : $m['message'];
                $time = date('M j, Y \a\t g:i A', strtotime($m['created_at']));
            ?>
            <tr style="<?= !$m['is_read'] ? 'background: #fef9e7;' : '' ?>">
                <td>
                    <strong style="<?= !$m['is_read'] ? 'color: var(--nav);' : '' ?>"><?= h($m['name']) ?></strong>
                </td>
                <td>
                    <a href="mailto:<?= h($m['email']) ?>" style="color: var(--nav); text-decoration: none; font-size: 0.85rem;"><?= h($m['email']) ?></a>
                </td>
                <td style="color: var(--muted); font-size: 0.82rem; max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <?= h($preview) ?>
                </td>
                <td style="color: var(--muted); font-size: 0.78rem; white-space: nowrap;">
                    <?= $time ?>
                </td>
                <td>
                    <?php if ($m['replied_at']): ?>
                        <span class="badge badge-green">Replied</span>
                    <?php elseif ($m['is_read']): ?>
                        <span class="badge badge-blue">Read</span>
                    <?php else: ?>
                        <span class="badge badge-gold">New</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="display: flex; gap: 6px;">
                        <a href="?action=view&id=<?= $m['id'] ?>" class="btn btn-outline btn-sm" title="View & Reply"><i class="fas fa-eye"></i></a>
                        <?php if (!$m['is_read']): ?>
                            <a href="?action=mark-read&id=<?= $m['id'] ?>" class="btn btn-outline btn-sm" title="Mark Read"><i class="fas fa-check"></i></a>
                        <?php else: ?>
                            <a href="?action=mark-unread&id=<?= $m['id'] ?>" class="btn btn-outline btn-sm" title="Mark Unread"><i class="fas fa-envelope"></i></a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?php endif; adminFooter(); ?>