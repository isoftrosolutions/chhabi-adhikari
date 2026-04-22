/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 12.0.2-MariaDB : Database - dschool_cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dschool_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `dschool_cms`;

/*Table structure for table `admin_users` */

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_users` */

insert  into `admin_users`(`id`,`username`,`password_hash`,`created_at`) values 
(1,'admin','$2y$12$GyRpJoAj.wbOtgJCsNUubuK3Mr6Xh2JWXMIWb/RSe1mCHQ9tPiEHC','2026-04-20 09:57:40');

/*Table structure for table `blog_posts` */

DROP TABLE IF EXISTS `blog_posts`;

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `category` varchar(100) DEFAULT 'General',
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `image_gradient` varchar(100) DEFAULT 'linear-gradient(135deg,#1a2f5a,#3b5998)',
  `image_icon` varchar(50) DEFAULT 'fas fa-newspaper',
  `author` varchar(255) DEFAULT 'Dr. Chhabi Adhikari',
  `is_published` tinyint(4) DEFAULT 1,
  `published_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog_posts` */

insert  into `blog_posts`(`id`,`title`,`slug`,`category`,`excerpt`,`content`,`image_path`,`image_gradient`,`image_icon`,`author`,`is_published`,`published_at`,`created_at`) values 
(13,'7 Secrets to Grow Your Business Beyond Limits','7-secrets-business','Business','Discover the subconscious secrets behind scaling your business and leading with impact.','<p>Your being a businessperson opens unlimited opportunities not only for yourself but also for countless others. Discover the 7 proven secrets to scaling up your business.</p>',NULL,'linear-gradient(135deg,#1a2f5a,#3b5998)','fas fa-chart-line','Dr. Chhabi Adhikari',1,'2026-04-20 10:31:35','2026-04-20 10:31:35'),
(14,'Whatever You Focus Upon Expands','whatever-you-focus-expands','Mindset','Learn to direct your focus intentionally and watch every area of your life transform with momentum.','<p>Whatever you focus upon expands — it is a simple rule of our subconscious mind. It helps expand the things that we have been focusing upon, for better or worse.</p>',NULL,'linear-gradient(135deg,#F5A623,#E87722)','fas fa-eye','Dr. Chhabi Adhikari',1,'2026-04-20 10:31:35','2026-04-20 10:31:35'),
(15,'Handling People in Business: The Art of Influence','handling-people-business','Leadership','Master NLP-based influence and motivation strategies that bring out the best in every person around you.','<p>When you wish to enhance the productivity of your organisation and increase profits, you need the support and engagement of the people working with you.</p>',NULL,'linear-gradient(135deg,#059669,#047857)','fas fa-users','Dr. Chhabi Adhikari',1,'2026-04-20 10:31:35','2026-04-20 10:31:35'),
(16,'The Power of NLP: Rewire Your Mind','power-of-nlp','NLP','NLP is a complete system for understanding how your brain creates your reality.','<p>Neuro-Linguistic Programming is not just a technique — it is a complete system for understanding how your brain creates your reality. Discover how NLP can help you break old patterns and install empowering beliefs.</p>',NULL,'linear-gradient(135deg,#7c3aed,#5b21b6)','fas fa-brain','Dr. Chhabi Adhikari',1,'2026-04-20 10:31:35','2026-04-20 10:31:35'),
(17,'Reprogram Your Wealth: The Money Mindset Shift','money-mindset-shift','Money Mastery','Learn how to identify and dissolve your limiting beliefs around wealth and abundance.','<p>Most financial struggles are not about money — they are about your beliefs about money. Learn how to identify and dissolve your limiting beliefs around wealth and abundance.</p>',NULL,'linear-gradient(135deg,#dc2626,#b91c1c)','fas fa-coins','Dr. Chhabi Adhikari',1,'2026-04-20 10:31:35','2026-04-20 10:31:35'),
(18,'The 5-Minute Morning Ritual That Changes Everything','5-minute-morning-ritual','Mindset','Discover a simple yet powerful 5-minute ritual that top performers use to prime their mindset.','<p>How you start your morning sets the tone for your entire day. Discover a simple yet powerful 5-minute ritual that top performers use to prime their mindset for success.</p>',NULL,'linear-gradient(135deg,#0891b2,#0e7490)','fas fa-lightbulb','Dr. Chhabi Adhikari',1,'2026-04-20 10:31:35','2026-04-20 10:31:35');

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(500) NOT NULL,
  `alt_text` varchar(500) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'General',
  `is_active` tinyint(4) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`title`,`image_path`,`alt_text`,`category`,`is_active`,`sort_order`,`created_at`) values 
(3,'NLP Training Workshop','/assets/Gemini_Generated_Image_pl1l98pl1l98pl1l.png','NLP Training Session','Training',1,0,'2026-04-20 10:51:37'),
(4,'Corporate NLP Program','/assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png','Corporate Training','Corporate',1,1,'2026-04-20 10:51:37'),
(5,'Transformation Stories','/assets/Gemini_Generated_Image_kwsdyvkwsdyvkwsd.png','Success Stories','Success',1,2,'2026-04-20 10:51:37'),
(6,'Certification Ceremony','/assets/Gemini_Generated_Image_q9bjvcq9bjvcq9bj.png','NLP Certification','Certificates',1,3,'2026-04-20 10:51:37'),
(7,'Interactive Workshop','/assets/WhatsApp Image 2026-02-10 at 2.58.03 PM.jpeg','Training Session','Training',1,4,'2026-04-20 10:51:37'),
(8,'Group Training Session','/assets/WhatsApp Image 2026-02-10 at 2.58.05 PM.jpeg','Group Training','Training',1,5,'2026-04-20 10:51:37');

/*Table structure for table `hero_slides` */

DROP TABLE IF EXISTS `hero_slides`;

CREATE TABLE `hero_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `btn1_text` varchar(100) DEFAULT NULL,
  `btn1_url` varchar(255) DEFAULT NULL,
  `btn2_text` varchar(100) DEFAULT NULL,
  `btn2_url` varchar(255) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `gradient` varchar(100) DEFAULT 'linear-gradient(155deg,#0d1b35,#1a2f5a)',
  `is_active` tinyint(4) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `hero_slides` */

insert  into `hero_slides`(`id`,`title`,`subtitle`,`btn1_text`,`btn1_url`,`btn2_text`,`btn2_url`,`image_path`,`gradient`,`is_active`,`sort_order`,`created_at`) values 
(7,'TRANSFORM YOUR MIND. TRANSFORM YOUR LIFE.','Discover the power of NLP with Dr. Chhabi Adhikari.','Explore Programs','courses.php','Watch Videos','videos.php',NULL,'linear-gradient(155deg,#0d1b35 0%,#1a2f5a 45%,#0f2040 100%)',1,0,'2026-04-20 10:31:35'),
(8,'MASTER YOUR SUBCONSCIOUS MIND','Unlock unlimited potential with NLP training in Nepal.','Start NLP Journey','nlp-practitioner.php','View Calendar','calendar.php',NULL,'linear-gradient(155deg,#1a2f5a 0%,#2d4a8a 60%,#1a2f5a 100%)',1,1,'2026-04-20 10:31:35'),
(9,'AWAKEN THE POWER WITHIN YOU','Join thousands who have transformed their lives with D-School System.','Join a Workshop','calendar.php','Our Success Stories','success-stories.php',NULL,'linear-gradient(155deg,#7c3aed 0%,#1a2f5a 60%,#0d1b35 100%)',1,2,'2026-04-20 10:31:35');

/*Table structure for table `newsletter_subscribers` */

DROP TABLE IF EXISTS `newsletter_subscribers`;

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `subscribed_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `newsletter_subscribers` */

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(100) DEFAULT 'fas fa-star',
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `services` */

insert  into `services`(`id`,`icon`,`title`,`description`,`link_url`,`is_active`,`sort_order`,`created_at`) values 
(13,'fas fa-brain','NLP Master Practitioner','The complete 5-day transformational NLP workshop. Master your subconscious mind.','courses.php',1,0,'2026-04-20 10:31:35'),
(14,'fas fa-user-tie','Train the Competent Life Coach','A 14-day residential workshop to become a certified professional life coach.','ttclc.php',1,1,'2026-04-20 10:31:35'),
(15,'fas fa-graduation-cap','NLP Practitioner','Your first step into the science of NLP. Reprogram limiting beliefs and create lasting change.','nlp-practitioner.php',1,2,'2026-04-20 10:31:35'),
(16,'fas fa-coins','Money Mastery','Dissolve money blocks and reprogram a wealth mindset. Discover the psychology of abundance.','money.php',1,3,'2026-04-20 10:31:35'),
(17,'fas fa-book-open','Student Memory Mastery','Enhance concentration, memory, and exam performance. The perfect academic edge.','memory.php',1,4,'2026-04-20 10:31:35'),
(18,'fas fa-building','Corporate Training','Customised in-house programs for organisations seeking leadership excellence.','personal-counseling.php',1,5,'2026-04-20 10:31:35');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`setting_key`,`setting_value`) values 
(1,'site_title','Dr. Chhabi Adhikari | D School System | NLP Training in Nepal'),
(2,'site_description','Certified NLP Trainer and Founder of D School System. Transform your life and career with expert coaching in Nepal.'),
(3,'site_tagline','Nepal\'s Leading NLP Institute'),
(4,'contact_phone','+977-9800000000'),
(5,'contact_email','info@dschoolsystem.com'),
(6,'contact_address','Kathmandu, Nepal'),
(7,'facebook_url','#'),
(8,'youtube_url','#'),
(9,'instagram_url','#'),
(10,'linkedin_url','#'),
(11,'footer_description','Nepal\'s Leading Authority in Personal Transformation. Founded by Dr. Chhabi Adhikari, dedicated to helping you master your subconscious mind.'),
(12,'stat_decades','2+'),
(13,'stat_lives','1M+'),
(14,'stat_cities','20+'),
(15,'stat_programs','50+'),
(16,'about_eyebrow','Meet the Founder'),
(17,'about_title','Dr. Chhabi Adhikari —\nNepal\'s Foremost NLP Authority'),
(18,'about_text1','For more than two decades, Dr. Chhabi Adhikari has been transforming lives through Neuro-Linguistic Programming. His generative learning methodology uniquely helps participants learn, experience, and apply NLP in a simple yet profoundly effective way.'),
(19,'about_text2','With workshops spanning Kathmandu, Pokhara, Butwal, Chitwan, and beyond — and NLP videos watched by millions — Dr. Chhabi is Nepal\'s most trusted voice in personal transformation, leadership, and the science of the subconscious mind.'),
(20,'cta_heading','Ready to Transform Your Life?'),
(21,'cta_subtext','Take the first step today. Join thousands of people who have already transformed their mindset, relationships, career, and health through D-School System.'),
(22,'hero_eyebrow','Nepal\'s Leading NLP Institute'),
(23,'hero_title_line1','Transform Your Mind.'),
(24,'hero_title_line2','Transform Your Life.'),
(25,'hero_subtitle','Discover the power of Neuro-Linguistic Programming with Dr. Chhabi Adhikari — Nepal\'s most trusted NLP trainer with over two decades of transformational impact.'),
(26,'why_title','Why D-School System?'),
(27,'why_subtitle','The standard of excellence that sets us apart'),
(28,'services_title','Our Transformational Programs'),
(29,'services_subtitle','Expertly designed programs to empower every area of your life'),
(30,'testimonials_title','Success Stories'),
(31,'blog_preview_title','Latest Insights'),
(32,'videos_title','Watch & Learn'),
(33,'about_image','assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png'),
(34,'hero_image','assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png');

/*Table structure for table `testimonials` */

DROP TABLE IF EXISTS `testimonials`;

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` tinyint(4) DEFAULT 5,
  `avatar_initial` char(2) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `testimonials` */

insert  into `testimonials`(`id`,`name`,`role`,`location`,`content`,`rating`,`avatar_initial`,`is_active`,`sort_order`,`created_at`) values 
(13,'Rajesh Shrestha','Entrepreneur','Kathmandu','Chhabi\'s NLP workshop completely changed the way I see myself and my business. Within three months of applying what I learned, my income doubled. The subconscious reprogramming is real and it works.',5,'R',1,0,'2026-04-20 10:31:35'),
(14,'Sunita Thapa','Teacher & Life Coach','Pokhara','I attended the NLP Master Practitioner workshop feeling stuck in life. I left with a completely new mindset. Dr. Chhabi has a gift for making complex psychology feel natural and immediately applicable.',5,'S',1,1,'2026-04-20 10:31:35'),
(15,'Priya Adhikari','Parent','Chitwan','The Student Memory Mastery program was a game-changer for my son. His grades improved dramatically and his confidence soared. Thank you, Dr. Chhabi!',5,'P',1,2,'2026-04-20 10:31:35'),
(16,'Bikash Gurung','Sales Manager','Butwal','After attending the Money Mastery workshop, I completely shifted my relationship with money. My sales performance improved by 200% and I finally feel in control of my financial destiny.',5,'B',1,3,'2026-04-20 10:31:35'),
(17,'Anita KC','Business Owner','Pokhara','The TTCLC life coaching program was transformational. I\'m now a certified coach helping others. Dr. Chhabi\'s teaching style is engaging, practical, and deeply impactful.',5,'A',1,4,'2026-04-20 10:31:35'),
(18,'Suresh Poudel','HR Director','Kathmandu','We brought Dr. Chhabi in for corporate training and it was the best investment we made. The team\'s communication and performance improved dramatically within weeks.',5,'S',1,5,'2026-04-20 10:31:35');

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `youtube_id` varchar(50) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'NLP',
  `bg_gradient` varchar(100) DEFAULT 'linear-gradient(135deg,#1a2f5a,#2d4a8a)',
  `is_active` tinyint(4) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `videos` */

insert  into `videos`(`id`,`title`,`description`,`youtube_url`,`youtube_id`,`category`,`bg_gradient`,`is_active`,`sort_order`,`created_at`) values 
(13,'Introduction to NLP & Subconscious Mind','Learn the fundamentals of Neuro-Linguistic Programming and how your subconscious mind works.','','','NLP','linear-gradient(135deg,#1a2f5a,#2d4a8a)',1,0,'2026-04-20 10:31:35'),
(14,'How to Reprogram Your Money Mindset','Discover the NLP techniques to break through money blocks and attract financial abundance.','','','Money Mastery','linear-gradient(135deg,#7c3aed,#4f26b5)',1,1,'2026-04-20 10:31:35'),
(15,'NLP Anchoring Technique for Instant Confidence','Learn the powerful NLP anchoring technique to access your best state on demand.','','','NLP','linear-gradient(135deg,#059669,#027a50)',1,2,'2026-04-20 10:31:35'),
(16,'Student Memory Mastery Techniques','Powerful memory techniques for students to improve concentration and retention.','','','Students','linear-gradient(135deg,#dc2626,#b91c1c)',1,3,'2026-04-20 10:31:35'),
(17,'Corporate Leadership with NLP','How to use NLP principles to become an extraordinary leader in your organisation.','','','Leadership','linear-gradient(135deg,#0891b2,#0e7490)',1,4,'2026-04-20 10:31:35'),
(18,'The Wheel of Life — Balance Your Life with NLP','Dr. Chhabi explains how to achieve balance across all areas of your life using NLP.','','','Personal Growth','linear-gradient(135deg,#F5A623,#c85f00)',1,5,'2026-04-20 10:31:35'),
(19,'gehara hua','','https://www.youtube.com/watch?v=GVizJ_jpUnw&list=RDGVizJ_jpUnw&start_radio=1','GVizJ_jpUnw','NLP','linear-gradient(135deg,#1a2f5a,#2d4a8a)',1,0,'2026-04-20 10:46:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
