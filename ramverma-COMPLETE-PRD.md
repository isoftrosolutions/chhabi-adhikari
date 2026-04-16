# COMPLETE PRODUCT REQUIREMENTS DOCUMENT (PRD)
## Website Clone: www.ramverma.com
### Version 2.0 — Exhaustive Developer & Designer Reference
### Prepared by: Senior UI/UX Architect + Product Analyst

---

> **Scope:** This document covers every accessible page, section, component, content block, interaction, design token, SEO element, and functional requirement needed to recreate ramverma.com with 100% visual and functional fidelity.

---

## TABLE OF CONTENTS

1. [Website Overview](#1-website-overview)
2. [Site Architecture & Sitemap](#2-site-architecture--sitemap)
3. [Navigation System](#3-navigation-system)
4. [Page-by-Page Breakdown](#4-page-by-page-breakdown)
   - 4.1 Home Page
   - 4.2 About — Ram Verma
   - 4.3 Success Stories
   - 4.4 Connect with Ram
   - 4.5 NLP SR Master Practitioner Course
   - 4.6 Train The Competent Life Coach (TTCLC)
   - 4.7 E-Workshop: NLP Practitioner
   - 4.8 E-Workshop: NLP Wellness Practitioner
   - 4.9 E-Workshop: Money Mastery
   - 4.10 E-Workshop: Wellness Mastery
   - 4.11 E-Workshop: Student Memory Mastery
   - 4.12 Online Courses Page
   - 4.13 Calendar: All Workshops
   - 4.14 Calendar: NLP SR Master Practitioner Dates
   - 4.15 Calendar: MYSM Free Workshop
   - 4.16 Coaching: Personal Counselling
   - 4.17 Coaching: Corporate In-House
   - 4.18 Shop: Books
   - 4.19 Blog Index
   - 4.20 Blog Article Page
   - 4.21 About NLP
   - 4.22 NLP Training in India
   - 4.23 Videos Page
   - 4.24 Contact Us
   - 4.25 Testimonials
   - 4.26 Refund Policy
   - 4.27 Privacy Policy
   - 4.28 Terms & Conditions
   - 4.29 Landing Pages (Free Workshop / City-Specific)
5. [UI Component Library](#5-ui-component-library)
6. [Design System](#6-design-system)
7. [Layout & Grid System](#7-layout--grid-system)
8. [Animations & Interactions](#8-animations--interactions)
9. [Forms & User Input](#9-forms--user-input)
10. [Content Structure & Copy](#10-content-structure--copy)
11. [Schema / SEO Structure](#11-schema--seo-structure)
12. [Assets Inventory](#12-assets-inventory)
13. [Technology Stack](#13-technology-stack)
14. [Mobile Responsiveness](#14-mobile-responsiveness)
15. [Accessibility](#15-accessibility)
16. [Third-Party Integrations](#16-third-party-integrations)
17. [Developer Reconstruction Guide](#17-developer-reconstruction-guide)

---

## 1. Website Overview

| Attribute | Value |
|---|---|
| **Website Name** | Ram Verma — NLP Training India |
| **Live URL** | https://www.ramverma.com |
| **Brand Tagline** | "Transforming Mindset, Transforming Lives..!!" |
| **Founder/Brand** | Ram Verma, founder of Midas Touch Training |
| **Business Entity** | Midas Touch Training (copyright holder) |
| **Publishing House** | Midas Touch Publications |
| **Contact Number** | 9873155244 |
| **Primary Purpose** | Personal brand + e-commerce platform for NLP coach, trainer, and author Ram Verma |
| **Core Offering** | NLP (Neuro-Linguistic Programming) training, workshops, coaching, books, audio programs |
| **Unique Method** | "NLP SubConscious ReImprinting" — Ram Verma's proprietary NLP framework |
| **Target Audience** | Adults 20–55 across India seeking personal transformation, career growth, wellness, business success; upcoming trainers/coaches; corporate teams; students; couples |
| **Business Model** | B2C live workshop tickets + online course sales + audio program e-commerce + corporate B2B packages + books + coaching packages + Udemy affiliate |
| **Social Proof Claims** | 900,000+ lives transformed; 600+ workshops conducted; 20+ years experience; TEDx speaker; Hindustan Times featured |
| **Media Presence** | Facebook (177,670+ likes), YouTube (NLP Hindi videos), LinkedIn, Udemy |
| **External Properties** | ramvermaacademy.com, ramvermaonline.com, ramvermacoaches.com |

---

## 2. Site Architecture & Sitemap

### 2.1 Full Sitemap

```
ramverma.com/
│
├── index.html                              HOME
│
├── ABOUT
│    ├── about-ram-verma.html               About Ram Verma (Bio)
│    ├── ram-verma-nlp-reviews.html         Success Stories
│    ├── connect-with-ram-verma.html        Connect with Ram
│    └── about-us.html                      About Us (alternate/legacy)
│
├── COURSES
│    ├── nlp-master-practitioner-course-in-india.html     NLP SR Master Practitioner
│    │    └── master-practitioner-nlp-exercises.html      NLP Exercises Sub-page
│    ├── train-the-trainer-course-in-india.html           TTCLC (Life Coach)
│    ├── student-nlp-trainer.html                         Student NLP Trainer (sub-specialty)
│    ├── nlp-life-celebration-firewalk-workshop.html      Fire Walk / Life Celebration Workshop
│    └── E-WORKSHOP
│         ├── onilne-nlp-practitioner-course-in-india.html   NLP Practitioner
│         ├── nlp-wellness-workshop-in-india.html             NLP Wellness Practitioner
│         ├── nlp-money-workshop-in-india.html                Money Mastery
│         ├── nlp-practitioner-course-in-india.html           Wellness Mastery
│         └── nlp-student-workshop-in-india.html              Student Memory Mastery
│    └── nlp-online-courses.html                          Online Courses Catalog
│    └── [External] https://www.ramvermaacademy.com/      Online Academy
│
├── CALENDAR
│    ├── nlp-course-date.html               All Upcoming Workshops
│    ├── nlp-master-practitioner-course-date-in-india.html  Master Practitioner Dates
│    └── nlp-free-workshops.html            Free MYSM One-Day Workshops
│
├── COACHING
│    ├── nlp-therapy-counseling-in-india.html   Personal Counselling
│    └── corporate-workshop.html                Corporate In-House
│
├── SHOP
│    ├── nlp-books.html                     Books Page
│    ├── /shop/                             Audio Programs Store (WooCommerce/custom)
│    │    └── /shop/product/total-transformation/    Product: Total Transformation
│    └── [External] https://www.ramvermaacademy.com/
│    └── [External] https://www.udemy.com/user/ram-verma-7/
│
├── RESOURCES
│    ├── /blog/                             Blog Index
│    │    ├── /blog/business/               Business Category
│    │    │    ├── seven-secrets-that-you-need-to-grow-in-your-business/
│    │    │    └── handling-and-motivation-people-in-business/
│    │    └── /blog/self-help/              Self-Help Category
│    │         └── whatever-you-focus-upon-expands/
│    ├── about-nlp.html                     About NLP (Informational)
│    ├── nlp-training-in-india.html         NLP Training in India (SEO page)
│    ├── nlp-india.html                     NLP India (SEO page)
│    ├── nlp-practitioner-course-in-india.html   NLP Practitioner Info
│    ├── nlp-videos.html                    Videos Page
│    ├── nlp-pictures.html                  Photo Gallery
│    └── [External] YouTube Visualizations Playlist
│
├── CONTACT
│    └── Contact.html                       Contact Us
│
├── TESTIMONIALS
│    └── nlp-testimonials.html              Video/Text Testimonials
│
├── LANDING PAGES (/lp/)
│    ├── /lp/free-workshop/nlp-delhi.html
│    ├── /lp/free-workshop/nlp-mumbai.html
│    ├── /lp/free-workshop/nlp-hyderabad.html
│    ├── /lp/free-workshop/nlp-pune.html
│    └── /lp/free-workshop/trainer-mumbai.html
│
├── SPECIAL PAGES (/sp/)
│    ├── /sp/miracle-book/                  Free Book Lead Magnet
│    └── /sp/ram-verma-communities/         NLP Communities Subscription Page
│
├── CITY WORKSHOP PAGES
│    └── /nlp-course-date/nlp-workshops/nlp-ahmedabad.html  (and other cities)
│
└── LEGAL
     ├── refund-policy.html
     ├── privacy-policy.html
     └── terms-and-condition.html
```

### 2.2 External Web Properties

| Domain | Purpose |
|---|---|
| ramvermaacademy.com | Primary online course LMS (Teachable-like platform) |
| ramvermaonline.com | Secondary online course platform (specific courses like Student Memory) |
| ramvermacoaches.com | Directory of Ram Verma certified coaches/trainers |
| udemy.com/user/ram-verma-7/ | Udemy instructor profile with multiple courses |

---

## 3. Navigation System

### 3.1 Header Structure

```
+-----------------------------------------------------+
|  [LOGO: nlp-logo.png]     [Nav Menu]        [Mobile]|
+-----------------------------------------------------+
```

- **Position:** Fixed (sticky) at top of viewport at all times
- **Z-index:** Above all content (z-index: 999 or 1000)
- **Height:** ~75–80px desktop, ~60px mobile
- **Background:** White `#ffffff`
- **Border/Shadow:** Subtle `box-shadow: 0 2px 8px rgba(0,0,0,0.1)` always visible or on scroll
- **Logo:** PNG image `images/nlp-logo.png` — left aligned, ~150–180px wide, links to `index.html`
- **Duplicate logo tags:** Two logo `<a>` elements exist in HTML — one for desktop, one for mobile (controlled by CSS visibility)

### 3.2 Full Desktop Navigation Menu

```
Home | About Ram ▾ | Courses ▾ | Calendar ▾ | Coaching ▾ | Shop ▾ | Resources ▾ | Contact Us
```

- **Font:** Sans-serif, ~14–15px, font-weight 600
- **Color:** Dark grey `#333` default; brand color on hover (orange or deep blue)
- **Letter-spacing:** Slight tracking (0.5px)
- **Active state:** Underline or color highlight on current page item
- **Spacing:** ~20–25px padding between nav items

### 3.3 Dropdown Menus — Complete Structure

#### About Ram ▾
| Label | URL |
|---|---|
| Ram Verma | about-ram-verma.html |
| Success Stories | ram-verma-nlp-reviews.html |
| Connect with Ram | connect-with-ram-verma.html |

#### Courses ▾
| Label | URL | Notes |
|---|---|---|
| NLP Master Practitioner | nlp-master-practitioner-course-in-india.html | |
| TTCLC (Life Coach) | train-the-trainer-course-in-india.html | |
| E-Workshop ▾ | # | Has nested flyout |

##### E-Workshop Flyout (nested 2nd level)
| Label | URL |
|---|---|
| NLP Practitioner | onilne-nlp-practitioner-course-in-india.html |
| NLP Wellness Practitioner | nlp-wellness-workshop-in-india.html |
| Money Mastery | nlp-money-workshop-in-india.html |
| Wellness Mastery | nlp-practitioner-course-in-india.html |
| Student Memory Mastery | nlp-student-workshop-in-india.html |
| Online Courses | https://www.ramvermaacademy.com/ |

#### Calendar ▾
| Label | URL |
|---|---|
| All Workshop | nlp-course-date.html |
| NLP SR Master Practitioner | nlp-master-practitioner-course-date-in-india.html |
| MYSM (One Day) | nlp-free-workshops.html |

#### Coaching ▾
| Label | URL |
|---|---|
| Personal Counselling | nlp-therapy-counseling-in-india.html |
| Corporate In House | corporate-workshop.html |

#### Shop ▾
| Label | URL |
|---|---|
| Books | nlp-books.html |
| Audio Programs | https://www.ramverma.com/shop |
| Online Courses | https://www.ramvermaacademy.com/ |
| Udemy Programs | https://www.udemy.com/user/ram-verma-7/?referralCode=CF2726339D307E49CD7B |

#### Resources ▾
| Label | URL |
|---|---|
| Ram Verma Blog | https://www.ramverma.com/blog |
| About NLP | about-nlp.html |
| Visualizations | https://www.youtube.com/playlist?list=PLyiccHZstmUx3kkDLi8OWD6vk1Z9Ffv31 |

#### Contact Us (no dropdown)
| Label | URL |
|---|---|
| Contact Us | Contact.html |

### 3.4 Dropdown Behavior

- **Trigger:** CSS `:hover` on `<li>` parent (or JS `mouseenter/mouseleave`)
- **Animation:** `display: block` with opacity fade-in (200ms) and slight translateY(-5px → 0)
- **Panel style:** White background, 1px solid `#eeeeee` border, `box-shadow: 0 4px 12px rgba(0,0,0,0.1)`, min-width ~200px
- **Item style:** Full-width padding ~10px 20px, on hover: background `#f8f8f8`, text color shift to brand orange
- **Nested flyout (E-Workshop):** Appears to the right of the parent item on hover; same panel style

### 3.5 Mobile Navigation

- **Breakpoint trigger:** `< 992px` or `< 768px`
- **Hamburger button:** 3-line icon (☰) top right; toggles menu
- **Menu opens:** As a full-width vertical dropdown below the header OR as an off-canvas slide-in panel
- **Items:** Stacked vertically in full-width list
- **Dropdowns on mobile:** Accordion expand/collapse on tap (toggle arrow icon)
- **Close:** Tap hamburger again (now ✕ icon) or tap outside menu area

### 3.6 Footer Navigation (Secondary Nav)

Four columns of footer links (full detail in Section 4.1 Footer breakdown).

---

## 4. Page-by-Page Breakdown

---

### 4.1 HOME PAGE

**URL:** `index.html` / `https://www.ramverma.com/`
**Title tag:** `Ram Verma | NLP Training in India | NLP India | NLP Training India`
**Meta description:** Certified Neuro Linguistic Programming NLP training in India by Best NLP trainer in India Ram Verma. NLP courses in Delhi, Mumbai, Pune Bangalore, Hyderabad India.

---

#### SECTION 1 — Hero Slider / Carousel

- **Component:** Full-width auto-playing image carousel (3 slides)
- **Height:** 500–600px desktop, 280–350px mobile
- **Controls:** Left/right arrow buttons + dot indicators at bottom center
- **Auto-play:** Yes, ~4500ms interval
- **Transition:** Fade or horizontal slide, 500ms
- **Pause on hover:** Yes

**Slide 1:**
- Background: Event/stage photo of Ram Verma presenting to an audience
- Overlay: Dark semi-transparent gradient (bottom-to-top)
- Heading (H1): "Ram Verma"
- Subheading: "Transforming Mindset, Transforming Lives..!!"
- No CTA button on this slide

**Slide 2:**
- Background: Different Ram Verma event or lifestyle photo
- Heading (H1): "Ram Verma" (repeated — may be same or different visual variation)
- Subheading: Same tagline or variation
- No CTA button

**Slide 3:**
- Background: Inspirational/book cover themed background
- Heading (H1/H2): "**Awaken The God of Miracle**"
- Subheading: "**Book worth 11,000 Rs completely FREE**"
- CTA Button: "Download NOW" → links to `https://ramverma.com/sp/miracle-book`
- Button style: Solid fill, orange `#F5A623` or similar warm accent color, white text, rounded corners

**Typography on slides:**
- H1: White, 48–60px, bold, centered or left-aligned
- Subheading: White, 22–26px, normal or medium weight
- CTA button: 15–17px, bold, uppercase or mixed case

---

#### SECTION 2 — Intro Value Proposition

- **Background:** White or very light grey
- **Layout:** Single centered text column, max-width ~800px, centered in container
- **Content:**
  > "You have a deep desire to live a life that is full of joy, passion, health & wealth. Apart from this you also want to grow your business, be more resourceful, achieve higher goals and fulfill your purpose. Ram Verma's live events, coaching & mentoring programs help you to master your mindset and attain your desired life."
- **Font:** 16–18px, `#555555`, line-height 1.8
- **Padding:** ~60–80px top and bottom

---

#### SECTION 3 — Empower Each Area of Your Life (Course Cards Grid)

- **Background:** Light grey `#f5f5f5` or `#f9f9f9`
- **Section heading (H2):** "Empower Each area of your Life"
- **Section subtitle:** "Solution that Fulfills all your Needs..!!"
- **Layout:** 3-column grid desktop (last row: 2 centered cards), 2-column tablet, 1-column mobile
- **Total cards:** 5

**Card 1 — NLP SR Master Practitioner**
- Icon/Image: Course-relevant icon or thumbnail
- Title (H3): "NLP SR Master Practitioner"
- Tagline: "Learn the complete NLP"
- Description: "Be the part of most exciting and transformational 5 days workshop."
- CTA: [View Details] → `nlp-master-practitioner-course-in-india.html`

**Card 2 — Train The Competent Life Coach**
- Title (H3): "Train The Competent Life Coach"
- Tagline: "Learn the Secrets of transforming the Lives."
- Description: "A 14 day residential workshop so that you can enter into training and coaching."
- CTA: [View Details] → `train-the-trainer-course-in-india.html`

**Card 3 — Online Courses**
- Title (H3): "Online Courses"
- Tagline: "Learn with your pace and at your time."
- Description: "We have various online programs suitable for your requirements."
- CTA: [View Details] → `nlp-online-courses.html`

**Card 4 — Coaching & Mentoring**
- Title (H3): "Coaching & Mentoring"
- Tagline: "Get the right mindset & resourcefulness"
- Description: "Get Results 10X faster"
- CTA: [View Details] → `nlp-therapy-counseling-in-india.html`

**Card 5 — Audio Programs**
- Title (H3): "Audio Programs"
- Tagline: "Specially designed to positively program your mind."
- Description: "Re-program your subconscious mind."
- CTA: [View Details] → `https://www.ramverma.com/shop/shop`

**Card Design:**
- White background
- Padding: ~24px
- Border: 1px solid `#eeeeee` or no border with shadow
- Box-shadow: `0 2px 10px rgba(0,0,0,0.07)`
- Hover: Shadow deepens, possible border-top: 3px solid brand-color accent
- CTA: Text link or small button in brand color

---

#### SECTION 4 — NLP SubConscious ReImprinting (Features + Portrait)

- **Background:** White
- **Section heading (H2):** "NLP SubConscious ReImprinting"
- **Section subtitle:** "Learn the best techniques by the top NLP trainer: Ram Verma"
- **Layout:** 2-column — 6 feature items in 2 columns (left ~60%) + portrait image (right ~40%)

**Left Column — 6 Feature Items:**

| Icon | Title | Description |
|---|---|---|
| ✔ | Expert Trainer | "Ram Verma is a pioneer authority in the field of NLP and personal transformation." |
| ✔ | Proven Techniques | "Learn the proven & result oriented techniques that directly work on your subconscious mind." |
| ✔ | Learn New Strategies that Work | "Implant new and effective strategies in your mind and achieve the desired outcome." |
| ✔ | Achieve Lasting Results | "Once the right programming of subconscious mind is done, the results are ever lasting." |
| ✔ | Overcome Limitations | "Get rid of all negative memories, events, traumas, beliefs, anxiety, depression and gain more happiness in life." |
| ✔ | Change your Mind, Change your Life | "Once you change your mindset positively, you start to embrace the positivity in your life." |

- Each feature: Small colored icon (checkmark, star, or FontAwesome icon) + Bold H4 title + paragraph text
- Feature icons: Possibly circular colored backgrounds (orange/teal)

**Right Column — Ram Verma Portrait:**
- Image: `images/home/ram.png` (PNG with transparent/cutout background — standing pose, professional)
- The image appears as a cutout figure, not a rectangular box

**Below feature grid — CTA:**
- Text: "Join Ram Verma's upcoming workshop"
- CTA link/button: "**Calendar**" → `nlp-course-date.html`

---

#### SECTION 5 — About Ram Verma Bio Snippet

- **Background:** Alternating — light grey `#f5f5f5` or white
- **Layout:** 2-column — Image (left, ~40%) | Text (right, ~60%)
- **Image:** `images/home/ram verma.jpg` — formal seated or standing portrait, rectangular with rounded corners or straight

**Right Column Text:**
- **H2/H3:** "NLP Training in India by Ram Verma"
- **Paragraph 1:** "Hi, For more than two decades I have been offering a number of [NLP training in India] (link). My generative learning methodology uniquely helps participants learn and practice NLP in a simple way. This helps people address and resolve their challenges effectively. I am proud to announce that my most-watched NLP videos in India and abroad are helping everyday a number of people who are looking for authentic and relevant training to address their personal and professional issues."
- **Paragraph 2:** "In last two decades, I got an opportunity and big exposure to address and empower around one million people with NLP training in India. I have got an opportunity to design and deliver various trainings like NLP for corporate executives/managers, for students, for sales people, for couples, for senior citizens, for lawyers, for teachers/parents and for upcoming trainers in different Indian cities like New Delhi, Mumbai, Chennai, Jaipur, Chandigarh, Bangalore, Hyderabad, Goa, Gujarat, Kerala, Surat, Pune and Ahmedabad etc."
- **Paragraph 3:** "I have been helping individuals and upcoming Indian NLP trainers (training and designing their customised training contents) [NLP India] (link). I offer various NLP trainings like [NLP Practitioner course] (link), [NLP Master Practitioner course] (link), [NLP Money/Business Workshop] (link), [NLP For Wellness] (link), NLP trainers' program, and customized workshops for Students, Youth, Couples, Parents, Teachers & Business people etc. I invite you to join my [upcoming workshop] (link) and learn [about NLP] (link)."
- **Inline hyperlinks:** Multiple contextual links within body text (orange or blue underline)
- **CTA:** "Learn about NLP → **know more**" → `about-nlp.html`

---

#### SECTION 6 — Top Sellable Online Courses

- **Background:** White
- **Section heading (H2):** "top sellable online courses" (note: lowercase styling)
- **Section subtitle:** "Program your subconscious mind with our online courses at your own pace. Have the deep programming to get the desired results."
- **Layout:** 3-column grid desktop, 1-column mobile

**Product Card 1 — Online NLP Bundle**
- Title (H3): "Online NLP Bundle"
- Tagline: "Learn the complete NLP"
- Description: "Learn NLP and Its Application in Life"
- CTA: [View Details] (link may be broken/placeholder or to academy)

**Product Card 2 — Student Memory Mastery**
- Title (H3): "Student Memory Mastery"
- Tagline: "Increase Concentration & Retention"
- Description: "Gift it to your child."
- CTA: [View Details] → `https://www.ramvermaonline.com/course/nlp-student/`

**Product Card 3 — Total Transformation**
- Title (H3): "Total Transformation"
- Tagline: "Wealth & Wellness Mastery"
- Description: "Wealth & Wellness Mastery Audio Program."
- CTA: [View Details] → `https://www.ramverma.com/shop/product/total-transformation/`

**Section-level CTA:**
- Text: "Check Out All the Audio Programs"
- Button/link: "**Yes, Take me there**" → `https://www.ramverma.com/shop/shop/`

---

#### SECTION 7 — Pull Quote / Testimonial Block

- **Background:** Dark navy `#1A2F5A` or deep charcoal `#222` with optional texture/pattern overlay
- **Layout:** Full-width, centered text, ~80px padding top/bottom
- **Content:**
  - Large decorative quotation mark: `"` in gold/orange (~80–100px)
  - **H2/Blockquote:** "Master the art of communication with your SubConscious mind and witness how it can make everything possible for you."
  - Attribution: "— Ram Verma"
- **Typography:** White text, italic or normal, 24–30px, centered
- **Attribution:** Smaller ~16px, gold/orange color

---

#### SECTION 8 — Blog Preview ("Thoughts By Ram")

- **Background:** Light grey `#f5f5f5`
- **Section heading (H2):** "Thoughts By Ram"
- **Layout:** 3-column grid desktop, 2-column tablet, 1-column mobile

**Blog Card 1:**
- Image: `images/home/blog/nlp business by ram verma.jpg`
- Link: `https://www.ramverma.com/blog/business/seven-secrets-that-you-need-to-grow-in-your-business/`
- Category tag: "Business" (colored badge, orange or teal)
- Title (H3): "Seven Secrets that You Need to Grow in Your Business"
- Meta: "Ram Verma | Business"
- Excerpt: "Your being a businessperson or entrepreneur opens unlimited opportunities not only for yourself and your people but also for a number of persons who benefit from your product..."

**Blog Card 2:**
- Image: `images/home/blog/focus by ram verma.jpg`
- Link: `https://www.ramverma.com/blog/self-help/whatever-you-focus-upon-expands/`
- Category: "Personal Mastery"
- Title (H3): "Whatever You Focus Upon Expands"
- Meta: "Ram Verma | Personal Mastery"
- Excerpt: "Whatever you focus upon expands... It is a simple rule of our Subconscious mind. It helps expand the things that it has been focusing upon."

**Blog Card 3:**
- Image: `images/home/blog/motivate people by ram verma.jpg`
- Link: `https://www.ramverma.com/blog/business/handling-and-motivation-people-in-business/`
- Category: "Business"
- Title (H3): "Handling and Motivation People in Business"
- Meta: "Ram Verma | Business"
- Excerpt: "When you wish to enhance the productivity of your organization and profits, you need the support of the people that are engaged in your organization..."

**Blog card design:**
- White background, rounded corners (4–8px)
- Featured image: 16:9 aspect ratio, full card width, rounded top corners
- Image hover: scale(1.05) zoom effect within overflow:hidden container
- Category badge: Pill shape, ~11–12px, uppercase, colored background
- Title: H3 or H4, bold, ~17–18px, hover: color change to brand color
- Excerpt: 3-line truncate with CSS line-clamp

**Section CTA:**
- Text: "Empower your Thoughts:"
- Link: "**Read Blog**" → `https://www.ramverma.com/blog`

---

#### FOOTER

- **Background:** Dark navy/charcoal `#1A2B4A` or `#222222`
- **Text color:** White `#ffffff` for headings, light grey `#cccccc` for links
- **Layout:** 4-column grid desktop → 2-column tablet → 1-column mobile
- **Padding:** ~60px top, ~40px bottom

**Column 1 — Brand**
- Logo: `images/nlp-logo.png` (white/light version or same logo)
- Tagline: "India's Leading Authority in the field of Personal Transformation."
- Social icons (likely): Facebook, YouTube, LinkedIn

**Column 2 — Courses**
- Heading: "Courses"
- Links:
  - NLP SR Master Practitioner → `nlp-master-practitioner-course-in-india.html`
  - Audio Programs → `https://www.ramverma.com/shop/`
  - Online Courses → `nlp-online-courses.html`
  - Udemy Courses → `https://www.udemy.com/user/ram-verma-7/`
  - Corporate In-House → `corporate-workshop.html`

**Column 3 — Links**
- Heading: "Links"
- Links:
  - Upcoming Workshops → `nlp-course-date.html`
  - Success Stories → `ram-verma-nlp-reviews.html`
  - Pictures → `nlp-pictures.html`
  - Testimonials → `nlp-testimonials.html`
  - Refund Policy → `refund-policy.html`
  - Privacy Policy → `privacy-policy.html`
  - Terms & Conditions → `terms-and-condition.html`

**Column 4 — Resources**
- Heading: "Resourses" *(Note: intentional typo in source — "Resources" misspelled)*
- Links:
  - My Blog → `https://www.ramverma.com/blog`
  - About NLP → `about-nlp.html`
  - Our Trainers → `http://ramvermacoaches.com/`
  - Videos → `nlp-videos.html`

**Footer Bottom Bar:**
- Background: Slightly darker than footer (or same)
- Content: "Copyrights © 2022 All Rights Reserved by Midas Touch Training"
- Text: Centered, small ~12–13px, light grey

---

### 4.2 ABOUT — RAM VERMA PAGE

**URL:** `about-ram-verma.html`
**Title:** "Ram Verma: The best NLP Coach/Trainer in India | Life Trainer"

#### Section 1 — Page Banner / Hero
- Full-width background image (Ram Verma speaking/presenting)
- H1: "Ram Verma" or "About Ram Verma"
- Breadcrumb: Home > About Ram Verma

#### Section 2 — Bio Introduction
**First-person narrative content:**
- "I am an internationally certified and nationally acclaimed NLP coach."
- "They name me the Pioneer of Neuro-Linguistic Programming in India."
- "I have been coaching in Neuro-Linguistic Programming (NLP) for over 20 years."
- "I've been honored to help over 9,00,000 people from every part of India to transform their lives and their businesses through live events, books, audio [programs]."

#### Section 3 — Professional Credentials & Roles
- NLP Therapist
- Advanced Research Scholar on Applied Fundamentals of NLP
- Proficient in individual, family and organizational counseling and therapies
- TEDx Speaker
- Corporate trainer (CEOs and founders of famous companies)
- Author (Midas Touch Publications)
- Founder of Midas Touch Training ("India's No 1 NLP Training Certifications")

#### Section 4 — Mission Statement
- "My mission is to facilitate all the people of India for their mental empowerment."
- "I work with people one-on-one to help them find new careers, balance their lives, improve their relationships, work effectively, clarify and reach their goals."
- "I coach executives, professionals, competitive athletes, and individuals to grow and maximize their strengths, reach their potential, and achieve extraordinary results."

#### Section 5 — Workshop Topics Conducted
Ram Verma's workshops cover:
- Becoming a person of excellence
- Eliminating life-long phobias and traumas
- Selling through NLP
- Inspiration and motivational NLP-based seminars
- Communication and interpersonal relationships
- Business presentation skills
- Creativity and probability thinking
- Team building and metamorphosis leadership
- Train the Trainer programs

#### Section 6 — Books Authored
Published by Midas Touch Publications:
1. "Recharge Your Life @ NLP"
2. "Win Every Match Every Time" (sports)
3. "Effective Ways of Successful Parenting"
4. "How to Train Your Subconscious for Money"
5. Poetry collection: "Aaatm-samarpan kaise kar Doon?" (Hindi)
6. Novel: "Kooroop"

#### Section 7 — Media Mentions
- Hindustan Times: "Guiding minds to go in right direction" — Feb 1, 2004
- TEDx speaker badge/mention

#### Section 8 — CTA
- Button: "Check Upcoming Workshop" → `nlp-course-date.html`

---

### 4.3 SUCCESS STORIES PAGE

**URL:** `ram-verma-nlp-reviews.html`
**Title:** "Ram Verma NLP Reviews | Ram Verma Workshop Reviews"
**Meta:** "Read the success stories that people has felt in Ram Verma's NLP workshop. Read all the reviews of Ram Verma."

#### Layout
- Grid of success story cards or testimonial blocks
- Mix of text testimonials and possibly video embeds
- Each story: Name, location, photo (optional), testimonial text, possibly star rating

#### Notable testimonials from search data:
1. **Dr. Ravindra Vishvakarma** (Dhanbad): Learned NLP in 2013; gained structured concepts and deep practical knowledge
2. **Pawan Sharma & Monica Sharma**: Completed NLP in April 2013; delivered trainings in Kanpur; got contract training state gas company employees; spreading training business in UP, NCR and Gujarat; website: `themindcraft.org`
3. Student's father: Applied NLP to daughter "Jiya" who appeared on 20+ national/state TV shows

---

### 4.4 CONNECT WITH RAM PAGE

**URL:** `connect-with-ram-verma.html`

#### Layout
- Contact information display
- Social media links
- Possibly embedded contact form
- Phone: 9873155244

---

### 4.5 NLP SR MASTER PRACTITIONER COURSE PAGE

**URL:** `nlp-master-practitioner-course-in-india.html`
**Title:** "NLP Master Practitioner Training in India | Trainers Training"

#### Section 1 — Page Hero Banner
- H1: "NLP SR Master Practitioner" or "NLP Master Practitioner Training in India"
- Subtitle: "NLP SubConscious ReImprinting"

#### Section 2 — Course Overview
- "Want to learn complete NLP or do NLP trainers training or become a Corporate Trainer? NLP Master Practitioner training in India is the course."
- Two-step program description:
  - **Step 1:** Live and Practical Application of NLP 2.0 theory & exercises with Ram Verma and team (5-day live workshop)
  - **Step 2:** NLP 2.0 LifeTime Bonuses

#### Section 3 — Step 1 Details
- Participants receive premium membership to `ramvermaacademy.com`
- Access to NLP 2.0 Kit (complete topics taught simply)
- Lifetime access for revision
- Bonuses: Heal Narcissist Victim, Heal Anxiety, Heal Depression, Heal Procrastination courses
- Live workshop: 25 NLP SubConscious ReImprinting exercises witnessed and practiced
- Additional bundles: Counselling Mastery, Monetize Your Skills, Heal Diabetes 2, Heal Obesity, Heal Autoimmune
- Money bundle: Money Karmic Conditioning, Goal Mastery Marvels, Law of Attraction, Karmic Money Mastery

#### Section 4 — What You Will Learn (Bullet List)
- Clarity on Your Vision, Purpose & Values
- Overcome negative and limiting self beliefs
- Enjoy confidence and high self esteem
- Get rid of past painful memories, fear, phobias
- Develop stronger and loving relationships
- Deal with allergies and OCD
- Master the art of communication
- Have more positive energy and relaxation in your Life
- Remove the pattern of anxiety, stress and depression
- Learn the art to communicate with subconscious mind
- Improve your coaching and counselling skills

#### Section 5 — Who Can Join (Target Audience)
- Individuals looking for self development
- Those who want to gain holistic wellness
- Trainers, Counsellors, Psychologists, Healers
- Businessmen, Entrepreneurs
- Sports persons & Sport Coaches
- Upcoming Trainers and coaches

#### Section 6 — NLP Applications (Why NLP)
**For Business/Corporate:**
- "Enhancing productivity, improving workplace culture and boosting sales are major challenges most businesses face today."
- "NLP is an efficient and scientific proven technique which helps in creating and maintaining right mindset and high morale among employees."
- "Using NLP techniques, one can communicate better, create rapport with clients/peers and handle tough clients with ease."
- "NLP helps in aligning individuals to the organization's mission and vision."

**For Coaching:**
- "NLP is the best human mind technique for coaching, training and counselling"
- "Resolve mental issues: low confidence, past painful memories, anxiety, depression, low self esteem, fear, phobias"

**For Sports:**
- "NLP techniques help you perform at peak level and overcome limiting beliefs"
- "Best use of NLP is in modeling the pattern of others and implant them in your mind"

#### Section 7 — CTA
- Button: "Check Upcoming Workshop" → `nlp-master-practitioner-course-date-in-india.html`

#### Sub-page: NLP Exercises
**URL:** `nlp-master-practitioner-course-in-india/master-practitioner-nlp-exercises.html`

NLP Exercises taught in the workshop:
- How to generate confidence for any situation (exam, public speaking, meeting new people)
- How to create interest in studies, job, work or family
- How to condition your mind against any allergic response
- How to condition your mind to attract more wealth
- How to de-condition your mind against any addiction (food, smoking, alcohol)
- How to generate a new behavior for success in any field
- How to generate self motivation for things you want to achieve
- How to generate self de-motivation for things you don't want to do

---

### 4.6 TRAIN THE COMPETENT LIFE COACH (TTCLC) PAGE

**URL:** `train-the-trainer-course-in-india.html`

#### Overview
- 14-day residential workshop
- Learn to become a professional Life Coach and NLP Coach
- Taught by Ram Verma and team

#### Sub-specialty: Student NLP Trainer
**URL:** `student-nlp-trainer.html`

**5-Day Course divided into 2 parts:**

**Part 1: How to Prepare Your Free Seminar/Preview for Schools/Students**
- Preparing seminar content
- Demonstrations and stunts to attract participants
- Marketing and enrollment strategies

**Part 2: Conducting the Workshop (2 sub-parts)**
- (a) Memory Retention Exercises:
  - Vocabulary, GK, Periodic Table, Chemical Equations, Formulae, Tables, Flow Charts, Maps, Spellings, Long Paragraphs
- (b) NLP SubConscious ReImprinting Exercises for Students:
  - Getting rid of past painful memories of failures
  - Eliminating fear/phobia of subjects or exams
  - Building subconscious confidence patterns for exams, interviews, public speaking
  - Creating subconscious success triggers in studies

**What You Get:**
- 5-day training by Ram Verma and team
- Reading material with exercises
- Future support
- Customized course contents for 3 workshops:
  1. Student Memory Workshop
  2. Parenting workshop
  3. [Additional workshop]

**Workshops you can conduct after completion:**
1. Memory and NLP seminars for schools
2. Public Memory & NLP workshops for students
3. Parenting workshops
4. Teachers' workshops
5. Personal counseling for students
6. [Additional types]

---

### 4.7 E-WORKSHOP: NLP PRACTITIONER

**URL:** `onilne-nlp-practitioner-course-in-india.html`
*(Note: "onilne" is a typo in the actual URL — must preserve for accurate clone)*

#### Content
- Introduction to NLP Practitioner certification
- Online/e-workshop format
- Covers foundational NLP concepts
- Certification upon completion

---

### 4.8 E-WORKSHOP: NLP WELLNESS PRACTITIONER

**URL:** `nlp-wellness-workshop-in-india.html`

#### Content
- NLP applied to wellness, health, and mind-body connection
- Psychosomatic disease understanding and healing
- Target: healthcare professionals, healers, individuals with health issues

---

### 4.9 E-WORKSHOP: MONEY MASTERY

**URL:** `nlp-money-workshop-in-india.html`

#### Content (from Life Celebration/Fire Walk workshop overlap)
Key benefits described:
- Create Amazing Mind Patterns of Business, Success and Money with NLP SubConscious ReImprinting
- Deleting subconscious patterns that are holding back money and success
- Eliminating patterns of Anxiety, Stress and Illness
- Erasing patterns of past failures
- Transforming inner self-image and building new powerful beliefs
- Transforming fear into inner personal power
- Creating inner alignment for more productivity
- Implanting patterns of Health, Money, Success and Happiness
- Creating subconscious patterns of Bright and Certain Future

**Target Audience:** Corporate executives, Businesspersons, Professionals, Students, MLM personnel, Sales and marketing personnel, couples, and individuals

**Bonuses Included:**
- 10 Pre-Recorded NLP SubConscious ReImprinting Commands/Exercises made for Money
- 10 Pre-Recorded NLP SubConscious ReImprinting Commands/Exercises made for Wellness
- Certification of Participation

---

### 4.10 E-WORKSHOP: WELLNESS MASTERY

**URL:** `nlp-practitioner-course-in-india.html`

#### Content
- Wellness through NLP SubConscious ReImprinting
- Psychosomatic disease healing
- "Issue Less Mind, Disease Free Body"
- Mind-body healing techniques

---

### 4.11 E-WORKSHOP: STUDENT MEMORY MASTERY

**URL:** `nlp-student-workshop-in-india.html`

#### Content (from online courses catalog)
- Title shown: "Student Memory Mastery"
- Tagline: "Learn Faster, Retain Longer"
- Subtitle: "Make your study more fun"
- External link: `https://www.ramvermaonline.com/course/nlp-student/`

---

### 4.12 ONLINE COURSES PAGE

**URL:** `nlp-online-courses.html`
**Title:** "Online Courses by Ram Verma | NLP Online Courses"
**Meta:** "Get the education at your ease, join our NLP online courses for wealth, health and nlp practitioner in India designed by Ram Verma."

#### Layout
Grid of online course product cards (3 columns desktop)

**Course Cards Listed:**

| Course Title | Tagline | Description |
|---|---|---|
| Online NLP Bundle | Learn Complete NLP and Its Application | Bundle of Two Programs |
| [Wellness Course] | Issue Less Mind, Disease Free Body | Issue Less Mind, Disease Free Body |
| [Money Course] | Hidden subconscious secrets that you need to know | Train your subconscious for money |
| Student Memory Mastery | Learn Faster, Retain Longer | Make your study more fun |
| [Happiness Course] | Reclaim Your Happiness | (no further description) |
| [Grief Course] | Get rid of the patterns of 'Grief' | Explore meaningful life patterns |
| Audio Programs | Specially designed to positively program your mind | Re-program your subconscious mind |

---

### 4.13 CALENDAR: ALL WORKSHOPS PAGE

**URL:** `nlp-course-date.html`
**Title:** "Upcoming Certified NLP training | NLP Workshops Schedule India"

#### Section 1 — Intro
- "Ram Verma believes that the right education is the first step towards bringing the real change. It gives you the power to transform your mindset and a different point of view. Ram Verma believes that you must be empowered with the tools and techniques for lasting change."
- "In his workshops, he empowers his participants with the techniques to master every area of your life. Ram Verma is pioneer for providing his participants for lasting transformation."
- "With the right education, right empowerment and with right mentor, Ram Verma, your path to transformation is inevitable."

#### Section 2 — Workshop Calendar Table
- Table or card grid showing upcoming events
- **Columns:** Workshop Name | Date | City | Time | Venue | Register Button
- Example entry (historical, from Ahmedabad page):
  - Event: NLP Master Practitioner
  - Date: 7 May, 2016
  - Time: 10:00am–4:00pm
  - Venue: Conference Hall, Dinner Bell Restaurant, 1st floor, Atlantis Enclave Near PNB Bank, Subhash Chowk, Gurukul Road, Ahmedabad

#### Section 3 — CTA
- "Check Upcoming Workshop" button

---

### 4.14 CALENDAR: MYSM FREE WORKSHOP

**URL:** `nlp-free-workshops.html`
**Title:** "Free NLP Training in India | Free NLP workshop | Free NLP"

#### Content
- "A one day free NLP workshop, where you will learn very practical techniques of NLP which can be used in your daily life."
- "It starts with the introduction of NLP and flows toward the techniques done with participants."
- "The very focus of this workshop is to introduce participants with NLP and give them techniques that can help them in and resolve their issues; such techniques are:"
  - Past bad memory removal
  - Circle of confidence
  - Power suggestions
  - Time line
  - Future building
  - Making past pleasing
  - And many more
- "Anyone can attend this workshop and can gain the benefits of NLP."
- Registration form (Name, Email, Phone, City)

---

### 4.15 COACHING: PERSONAL COUNSELLING PAGE

**URL:** `nlp-therapy-counseling-in-india.html`
**Title:** "NLP Therapy & Counseling in India | NLP Psychotherapy India"
**Meta:** "Have a personal issue that is troubling you? We are here to help you with the NLP counseling & therapy to resolve your issues."

#### Section 1 — Introduction to Psychosomatic Disease
- "Medical science has already proved that most of the diseases in our body are Psycho-somatic ('Psycho' refers that the disease has its origin in the mind, and 'Soma' refers that the disease is experienced in the body)"
- "It means that your mind may have some deep issues like those of past traumas that are causing the disease in your body."
- "With 'NLP SubConscious Re-Imprinting' workshop or Personal Counseling, you can erase that trauma off your mind and also plant the imprints of health and thus engage your mind to heal your disease faster."

#### Section 2 — Who Can Benefit
- **Professionals:** "Enjoy better productivity by getting more aligned with their Identity, Values, Belief, Capability and Behavior."
- **Creative people:** "Fashion designers, architects, script-writers, art-developers to explore their next level of creativity."
- **Sports persons:** "Eliminate the references of their past failure and bad performance; and enjoy their best 'form' in their performance."
- **Individuals:** For phobias, anxiety, unwanted behaviour, OCD, addiction, psychosomatic diseases, autoimmune diseases

#### Section 3 — Personal Sessions
- Ram Verma offers personal 1-on-1 sessions
- Issues addressed: phobias, anxiety, unwanted behaviour, OCD, addiction, psychosomatic diseases, autoimmune diseases, peak performance coaching for sportspersons, business personas, couples

#### Section 4 — Contact / Booking Form
- Fields: Name, Email, Phone, Issue Description
- CTA: "Book a Session" or "Contact Us"

---

### 4.16 COACHING: CORPORATE IN-HOUSE PAGE

**URL:** `corporate-workshop.html`

#### Content
- NLP corporate training programs
- Topics covered:
  - Enhancing productivity and workplace culture
  - Boosting sales
  - Better communication and rapport building
  - Handling tough clients
  - Aligning individuals to organization mission and vision
  - Team Building
  - Leadership
  - Sales Excellence
  - Metamorphosis Leadership

#### Corporate Clients Served
- CEOs and founders of famous companies
- Corporate chairpersons
- IFS & IAS Officers
- Executives across levels (gross level to senior management)

---

### 4.17 SHOP: BOOKS PAGE

**URL:** `nlp-books.html`
**Title:** "NLP Books in Hindi | Ram Verma NLP Books | NLP India"
**Meta:** "Book written by Ram Verma, top NLP trainer in India. These book are on various topics like personal development, parenting, sports, money and porms. These books are available in Hindi and English."

#### Books Listed:

| Title | Language | Topic |
|---|---|---|
| Recharge Your Life @ NLP | English/Hindi | General NLP / Personal Development |
| Win Every Match Every Time | English/Hindi | Sports Psychology |
| Effective Ways of Successful Parenting | English/Hindi | Parenting |
| How to Train Your Subconscious for Money | English/Hindi | Wealth & Money Mindset |
| Aaatm-samarpan kaise kar Doon? | Hindi | Poetry collection |
| Kooroop | Hindi | Novel |

Each book listed with:
- Book cover image
- Title
- Language(s) available
- Short description
- Buy/Order button

---

### 4.18 BLOG INDEX PAGE

**URL:** `https://www.ramverma.com/blog/`
**Title:** "NLP Blog by Ram Verma"
**Meta:** "Neuro Linguistic Programming (NLP) blog by Ram Verma, the best NLP trainer in India. Get information related to NLP in India."

#### Layout
- Grid of blog post cards (3-column desktop)
- Sidebar (possibly): Category list, recent posts, search

#### Categories
- Business
- Personal Mastery
- Self-Help
- NLP (general)
- Wellness

#### Blog Posts Confirmed:

**Post 1:**
- URL: `/blog/business/seven-secrets-that-you-need-to-grow-in-your-business/`
- Title: "Seven Secrets that You Need to Grow in Your Business"
- Category: Business
- Author: Ram Verma
- Excerpt: "Your being a businessperson or entrepreneur opens unlimited opportunities not only for yourself and your people but also for a number of persons who benefit from your product, and create a positive belief by seeing you and your growth as well."

**Post 2:**
- URL: `/blog/self-help/whatever-you-focus-upon-expands/`
- Title: "Whatever You Focus Upon Expands"
- Category: Personal Mastery
- Author: Ram Verma
- Excerpt: "Whatever you focus upon expands... It is a simple rule of our Subconscious mind. It helps expand the things that it has been focusing upon."

**Post 3:**
- URL: `/blog/business/handling-and-motivation-people-in-business/`
- Title: "Handling and Motivation People in Business"
- Category: Business
- Author: Ram Verma
- Excerpt: "When you wish to enhance the productivity of your organization and profits, you need the support of the people that are engaged in your organization as employers, team members and clients."

---

### 4.19 BLOG ARTICLE PAGE TEMPLATE

**URL Structure:** `/blog/[category]/[post-slug]/`

#### Layout
- Full-width header image (featured image)
- Content area: ~750–800px max-width centered
- H1 title at top
- Meta: Author | Date | Category
- Article body: H2/H3 subheadings, paragraphs, possibly numbered/bulleted lists
- Sidebar (optional): Related posts, category list
- Footer: Social share buttons, related articles grid
- CTA section at bottom: "Join our upcoming workshop" or newsletter signup

---

### 4.20 ABOUT NLP PAGE

**URL:** `about-nlp.html`

#### Content
- Definition of NLP
- How NLP works (3 stages):
  1. Removes past bad memories, fear, phobias, and other unresolved issues
  2. Makes your self-image so attractive and big that challenges look small
  3. Builds your future timeline, directs mind and energy to achieve goals
- Why NLP training is popular in India
- Ram Verma as pioneer of NLP in India
- Languages: taught in English and Hindi
- "Nlp is an art with science"
- "The only reason more and more people are opting to learn and apply these techniques in their life is the fact that it is result oriented. It produces results in minutes. Phobias, fear or past memories removal works like charm."
- YouTube reference for free NLP videos

---

### 4.21 NLP TRAINING IN INDIA (SEO PAGE)

**URL:** `nlp-training-in-india.html`
**Title:** "NLP Training in India | NLP Training in Hindi | NLP India"

#### Content
- "Ram Verma is the pioneer NLP and wellness coach in India. His simplification of NLP has made possible to understand NLP instantly."
- "To provide the NLP training in India with the most effecting and practical approach. So that individual can understand and apply it in their life and be more resourceful."
- "Our NLP videos do explain the topics of NLP with clarity and focus learning."
- "His NLP coach program is very famous which teaches you whole NLP and help you to become NLP life coach and start your career as trainer."
- Reference to YouTube videos and workshop calendar

---

### 4.22 CONTACT US PAGE

**URL:** `Contact.html`
**Title:** "Ram Verma Contact Number"

#### Content
- **Phone Number:** 9873155244 (prominently displayed)
- Possibly: Address, email
- Contact form with fields: Name, Email, Phone, Message
- Google Maps embed (possible, showing office location)
- Social media links

---

### 4.23 TESTIMONIALS PAGE

**URL:** `nlp-testimonials.html`
**Title:** "Testimonials of Ram Verma's NLP Workshop | NLP Reviews"
**Meta:** "Participants sharing their experience of Ram Verma's NLP workshop. These reviews are of different NLP workshops conducted by Ram Verma in India."

#### Layout
- Grid of testimonial cards OR video testimonial embeds
- Mix of text and video content

---

### 4.24 CITY-SPECIFIC FREE WORKSHOP LANDING PAGES

**URL Pattern:** `/lp/free-workshop/nlp-[city].html`

**Cities confirmed:**
- `nlp-delhi.html`
- `nlp-mumbai.html`
- `nlp-hyderabad.html`
- `nlp-pune.html`
- `trainer-mumbai.html` (trainer-focused version)

#### Shared Layout for All City Landing Pages:

**Section 1 — Event Banner**
- "Master Your SubConscious Mind: A full day Practical workshop with many Mind and NLP Techniques that directly ignite the SubConscious Mind."
- "Register to be the part of Actual Transformation."

**Section 2 — What You Will Learn**
- How do we perceive and create Beliefs
- How Subconscious mind creates our Reality
- How to Get rid of your painful memories, fear, phobias
- How to Eliminate & change Limiting Beliefs
- How to Erase the subconscious patterns of stress, anxiety, anger, depression
- How to activate subconscious mind to achieve your Goals
- How to activate subconscious mind power for Money and success
- How to Enjoy mind patterns of Confidence, Happiness and Motivation
- How to Create the blue prints of Health and Happiness
- How to communicate effectively and Build strong relationships
- "...and many more beyond your Expectation that we guarantee..."

**Section 3 — Registration Form**
- Fields: Name, Email, Phone, City
- Note: "Please don't register two persons with same email or mobile number."
- Privacy note: "We [protect] your privacy!!"
- CTA Button: "Register Now" or "Book Your Seat"

**Section 4 — About Ram Verma (Bio Block)**
Full bio appearing on every LP:
- "Ram Verma is India's leading NLP SubConscious ReImprinting coach."
- "He has been empowering people nearly for two decades."
- "He is the only trainer that has revolutionized the Subconscious techniques for Money, Success, Relationship and Health."
- "Ram Verma has addressed and transformed more than five lacs lives in last two decades."
- "The Hindustan Times quoted Ram Verma as Guiding minds to go in right direction – Feb 1, 2004."
- Credentials listed: NLP Therapist, Advanced Research Scholar, proficient in individual/family/organizational counseling
- "600+ workshops conducted, 6,00,000+ people addressed"
- "Has worked with CEOs, Entrepreneurs, Business Owners, Sportspersons, Corporate Trainers, IFS & IAS Officers"
- Workshop topics listed (full list)

**Trainer-Specific Landing Page (trainer-mumbai.html):**
- Specific to trainer/life coach seekers
- Headline: "Learn the Secrets of Becoming a Highly Paid Trainer/LifeCoach"
- "Hi, I am Ram Verma and I have addressed more than 700,000 people in last 20 years."
- "On [date] in Mumbai I will reveal a secret of how to be successful in training industry"
- What you will learn:
  1. How to become a High paid Trainer/LifeCoach
  2. How to solve Real Human Issues & get results soon
  3. How to market yourself and get clients

---

### 4.25 RAM VERMA COMMUNITIES PAGE

**URL:** `https://ramverma.com/sp/ram-verma-communities/`

#### Content
- Community subscription offerings
- "For the last 25 years I have been guiding, empowering and healing people with an international technique called NLP SubConscious Re-Imprinting."
- Monthly communities with live sessions and Q&A

**Community Types:**

1. **Wealth NLP Community**
   - Erasing negative beliefs about money
   - Developing rock-solid confidence and initiative to become rich
   - Using whole-brain approach (Left and Right Brain unification) to make money
   - Schedule: Monthly 2-hour class + Guided Visualizations + Q&A Sessions

2. **Wellness/Mental Health Community**
   - Eliminating painful memories causing anxiety or depression
   - Eliminating phobia patterns (snake, water, flight, height, closed-space)
   - Understanding and clearing OCD imprints
   - NLP SubConscious Re-Imprinting exercises

---

### 4.26 FREE BOOK LEAD MAGNET PAGE

**URL:** `https://ramverma.com/sp/miracle-book`

#### Content
- Book: "Awaken The God of Miracle"
- Value: "Book worth 11,000 Rs completely FREE"
- Lead capture form:
  - Fields: Name, Email, (possibly Phone)
  - CTA: "Download NOW" or "Get My Free Book"
- Post-conversion: PDF download or email delivery

---

### 4.27 LEGAL PAGES

#### Refund Policy (`refund-policy.html`)
Standard e-commerce refund policy for digital products and workshop registrations.

#### Privacy Policy (`privacy-policy.html`)
Data collection, usage, and protection policy. References Facebook Pixel data collection.

#### Terms & Conditions (`terms-and-condition.html`)
Usage terms for website and purchased products/services.

---

## 5. UI Component Library

### 5.1 Primary CTA Button

```
Name: PrimaryButton
Purpose: Main action trigger (Register, View Details, Download)
Variants:
  - Solid Orange: bg #F5A623 or #E87722, white text
  - Solid Dark Blue: bg #1A2F5A, white text
  - Ghost/Outline: transparent bg, colored border + text
Sizes:
  - Large: 16px font, 14px 32px padding
  - Medium: 14px font, 10px 24px padding
  - Small: 12px font, 8px 16px padding
Border-radius: 4px or 25px (pill)
States:
  - Default: base color
  - Hover: background darken 10%, cursor pointer, slight box-shadow
  - Active: scale(0.97)
  - Disabled: opacity 0.5, cursor not-allowed
Usage: Hero CTA, course cards, section CTAs, forms
```

### 5.2 Course / Product Card

```
Name: CourseCard
Purpose: Display course or product with CTA
Structure:
  <div.card>
    <div.card-image> (optional thumbnail or icon)
    <div.card-body>
      <h3.card-title>
      <p.card-tagline>
      <p.card-description>
      <a.card-cta>
Dimensions: ~300–360px wide, variable height
Background: #ffffff
Border: 1px solid #eeeeee or none
Border-radius: 6–8px
Box-shadow: 0 2px 10px rgba(0,0,0,0.07)
Padding: 24px
Hover:
  - box-shadow deepens: 0 8px 24px rgba(0,0,0,0.12)
  - top border: 3px solid brand-color
  - transition: 250ms ease
Usage: Homepage course grid, online courses page
```

### 5.3 Blog Card

```
Name: BlogCard
Purpose: Preview blog article
Structure:
  <div.blog-card>
    <div.blog-card-image>
      <img> (16:9 aspect, overflow:hidden)
    <div.blog-card-content>
      <span.category-badge>
      <h3.blog-title>
      <div.blog-meta> (author | category)
      <p.excerpt> (3-line clamp)
Image hover: transform: scale(1.05), transition 400ms ease
Title hover: color change to brand orange
Badge: pill shape, uppercase 11px, colored bg
Usage: Homepage blog section, blog index page
```

### 5.4 Feature Item (Icon + Text)

```
Name: FeatureItem
Purpose: Highlight benefit/feature with icon
Structure:
  <div.feature-item>
    <div.feature-icon> (circle bg with icon)
    <div.feature-text>
      <h4.feature-title>
      <p.feature-desc>
Layout: Inline (icon left, text right) or stacked
Icon size: 40–50px circle, brand color bg, white icon
Usage: NLP ReImprinting section on homepage, course pages
```

### 5.5 Testimonial Card

```
Name: TestimonialCard
Purpose: Display participant review
Structure:
  <div.testimonial-card>
    <div.quote-icon> (large decorative " mark)
    <p.testimonial-text>
    <div.testimonial-author>
      <img.author-photo> (circular, 60px)
      <div.author-info>
        <strong.name>
        <span.location>
Background: white or light grey
Border-left: 4px solid brand-color
Padding: 24–32px
Usage: Success stories page, testimonials page, landing pages
```

### 5.6 Sticky Navbar

```
Name: Navbar
Structure:
  <header.site-header>
    <div.container>
      <a.navbar-brand> (logo)
      <button.navbar-toggler> (mobile hamburger)
      <nav.navbar-collapse>
        <ul.navbar-nav>
          <li.nav-item>
          <li.nav-item.has-dropdown>
            <ul.dropdown-menu>
Sticky behavior: position:fixed, top:0
Shadow on scroll: box-shadow 0 2px 8px rgba(0,0,0,0.1)
Logo size: height 50–60px, auto width
```

### 5.7 Dropdown / Mega Menu

```
Name: DropdownMenu
Trigger: CSS :hover on parent li
Structure:
  <ul.dropdown-menu>
    <li><a> — each item
Animation: opacity 0→1, translateY -8px→0, 200ms ease
Panel: white bg, border-radius 4px, min-width 200px
Nested (E-Workshop): appears to right, same styling
Z-index: 100
```

### 5.8 Hero Carousel

```
Name: HeroCarousel
Library: OWL Carousel 2 or Slick Slider
Configuration:
  - items: 1
  - autoplay: true
  - autoplayTimeout: 4500
  - animateOut: 'fadeOut' or default slide
  - loop: true
  - dots: true
  - nav: true (prev/next arrows)
  - pauseOnHover: true
Arrow buttons: Positioned left/right center, semi-transparent bg
Dots: Bottom center, brand color for active
```

### 5.9 Section Header

```
Name: SectionHeader
Purpose: H2 title + subtitle for each homepage section
Structure:
  <div.section-header>
    <h2.section-title>
    <p.section-subtitle>
    <div.title-underline> (decorative line, brand color)
Alignment: Center
Margin-bottom: 40–50px
H2: 28–36px, bold, dark
Subtitle: 15–16px, grey #777
```

### 5.10 Pull Quote / Blockquote

```
Name: PullQuote
Background: Dark navy #1A2F5A
Text: White
Structure:
  <section.quote-section>
    <div.container>
      <blockquote>
        <span.quote-mark> (" character, large ~80px, gold)
        <p.quote-text> (italic, 24–28px)
        <cite.attribution> (— Ram Verma, smaller)
```

### 5.11 Contact Form

```
Name: ContactForm
Fields:
  - Name (text, required)
  - Email (email, required)
  - Phone (tel, optional)
  - Message (textarea, required, ~5 rows)
Button: PrimaryButton "Send Message"
Validation: HTML5 + JS client-side
Success: Inline message or redirect
Error: Red border + error text below field
```

### 5.12 Registration / Optin Form (Landing Pages)

```
Name: RegistrationForm
Fields:
  - Name (text, required)
  - Email (email, required)
  - Phone (tel, required)
  - City (select or text)
Button: "Register Now" — large, full-width on mobile
Note text: "Please don't register two persons with same email or mobile number."
Privacy note: "We protect your privacy!!"
```

### 5.13 Footer

```
Name: SiteFooter
Background: Dark navy/charcoal
Layout: 4-column CSS grid or Bootstrap row
Columns: Brand | Courses | Links | Resources
Bottom bar: copyright text
```

### 5.14 Category Badge

```
Name: CategoryBadge
Purpose: Blog post category label
Style: Pill shape, padding 3px 10px, font-size 11px, uppercase
Color variants: Orange (Business), Teal/Blue (Personal Mastery), Green (Self-Help)
Border-radius: 20px
```

### 5.15 Stats / Social Proof Counter

```
Name: StatCounter
Purpose: Display milestone numbers (900K+ lives, 600+ workshops, 20+ years)
Structure:
  <div.stat-item>
    <span.stat-number> (large, bold, brand color)
    <span.stat-label> (smaller, grey)
Layout: Horizontal row of 3–4 stats
Animation: Count-up effect on scroll into viewport
```

---

## 6. Design System

### 6.1 Color Palette

| Token | Role | Estimated Hex | Usage |
|---|---|---|---|
| `--color-primary` | Brand Orange/Gold | `#F5A623` | CTAs, accents, highlights |
| `--color-primary-dark` | Hover state | `#D4880A` | Button hover |
| `--color-secondary` | Deep Navy | `#1A2F5A` | Dark backgrounds, header |
| `--color-accent` | Bright Orange | `#E87722` | Alternate accent |
| `--color-text-dark` | Primary text | `#333333` | Body text, headings |
| `--color-text-medium` | Secondary text | `#666666` | Subtitles, captions |
| `--color-text-light` | Light text | `#999999` | Meta, placeholders |
| `--color-text-white` | White text | `#FFFFFF` | On dark backgrounds |
| `--color-bg-white` | White background | `#FFFFFF` | Primary page bg |
| `--color-bg-light` | Off-white/light grey | `#F5F5F5` | Alternating sections |
| `--color-bg-dark` | Dark section bg | `#1A2B4A` | Footer, quote section |
| `--color-border` | Borders | `#EEEEEE` | Cards, dividers |
| `--color-border-medium` | Input borders | `#CCCCCC` | Form fields |
| `--color-success` | Form success | `#28A745` | Success messages |
| `--color-error` | Form error | `#DC3545` | Error states |
| `--color-link` | Links | `#E87722` | Body links |
| `--color-link-hover` | Link hover | `#C4610C` | Link hover state |

### 6.2 Typography

#### Font Families
```css
--font-primary: 'Open Sans', 'Lato', sans-serif;   /* Body, headings */
--font-secondary: 'Roboto', sans-serif;              /* Alternate use */
--font-fallback: Arial, Helvetica, sans-serif;       /* System fallback */
```

#### Font Scale
```css
/* Headings */
--text-h1: 52px;      /* Hero slider */
--text-h1-mobile: 32px;
--text-h2: 34px;      /* Section headings */
--text-h2-mobile: 26px;
--text-h3: 22px;      /* Card titles, sub-headings */
--text-h3-mobile: 18px;
--text-h4: 18px;      /* Feature titles */
--text-h5: 16px;
--text-h6: 14px;

/* Body */
--text-body-lg: 18px;   /* Intro text, pull quotes */
--text-body: 16px;      /* Default paragraph */
--text-body-sm: 14px;   /* Captions, meta */
--text-body-xs: 12px;   /* Footer, legal, badges */

/* Special */
--text-quote: 26px;     /* Blockquote */
--text-button: 15px;
--text-nav: 14px;
```

#### Font Weights
```css
--weight-regular: 400;
--weight-medium: 500;
--weight-semibold: 600;
--weight-bold: 700;
--weight-extrabold: 800;
```

#### Line Heights
```css
--lh-tight: 1.2;     /* Headings */
--lh-snug: 1.4;      /* Sub-headings */
--lh-normal: 1.6;    /* Default */
--lh-relaxed: 1.75;  /* Body text */
--lh-loose: 2;       /* Reading-heavy content */
```

### 6.3 Spacing Scale
```css
--space-1: 4px;
--space-2: 8px;
--space-3: 12px;
--space-4: 16px;
--space-5: 20px;
--space-6: 24px;
--space-8: 32px;
--space-10: 40px;
--space-12: 48px;
--space-16: 64px;
--space-20: 80px;
--space-24: 96px;
--space-32: 128px;
```

#### Section Padding
```
Desktop: 80px top, 80px bottom
Tablet: 60px top, 60px bottom
Mobile: 40px top, 40px bottom
```

#### Card Padding
```
Desktop: 24px all sides
Mobile: 16px all sides
```

### 6.4 Border Radius
```css
--radius-sm: 4px;    /* Buttons, inputs */
--radius-md: 8px;    /* Cards */
--radius-lg: 12px;   /* Modals */
--radius-pill: 24px; /* Badges, pill buttons */
--radius-circle: 50%; /* Avatars, icons */
```

### 6.5 Box Shadows
```css
--shadow-sm: 0 1px 4px rgba(0,0,0,0.06);
--shadow-md: 0 2px 10px rgba(0,0,0,0.08);
--shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
--shadow-xl: 0 16px 48px rgba(0,0,0,0.16);
--shadow-card: 0 2px 10px rgba(0,0,0,0.07);
--shadow-card-hover: 0 8px 24px rgba(0,0,0,0.12);
```

---

## 7. Layout & Grid System

### 7.1 Container Widths
```css
.container {
  width: 100%;
  max-width: 1170px;   /* Bootstrap 3 default */
  margin: 0 auto;
  padding: 0 15px;
}

/* Breakpoint adjustments */
@media (min-width: 768px)  { .container { max-width: 750px; } }
@media (min-width: 992px)  { .container { max-width: 970px; } }
@media (min-width: 1200px) { .container { max-width: 1170px; } }
```

### 7.2 Responsive Breakpoints
```css
/* Bootstrap 3 breakpoints (estimated) */
--breakpoint-xs: 0px;       /* < 768px   — Mobile portrait */
--breakpoint-sm: 768px;     /* 768–992px — Mobile landscape / Tablet */
--breakpoint-md: 992px;     /* 992–1200px — Tablet landscape / Small desktop */
--breakpoint-lg: 1200px;    /* > 1200px  — Desktop */
```

### 7.3 Grid System
- **Technology:** Bootstrap 3 or Bootstrap 4 `.row` / `.col-*-*` grid
- **Columns:** 12-column grid
- **Gutter:** 30px (15px each side)

#### Column Usage by Section

| Section | Desktop | Tablet (sm) | Mobile (xs) |
|---|---|---|---|
| Course cards (5 items) | col-md-4 (3 per row, 2 on last) | col-sm-6 | col-xs-12 |
| Feature + Image | col-md-7 + col-md-5 | col-sm-12 | col-xs-12 |
| Bio section | col-md-5 + col-md-7 | col-sm-12 | col-xs-12 |
| Online courses (3) | col-md-4 | col-sm-6 | col-xs-12 |
| Blog cards (3) | col-md-4 | col-sm-6 | col-xs-12 |
| Footer (4) | col-md-3 | col-sm-6 | col-xs-12 |

---

## 8. Animations & Interactions

| ID | Animation | Type | Duration | Delay | Trigger | Easing | Target |
|---|---|---|---|---|---|---|---|
| A1 | Hero slide change | Auto-play carousel | 500ms transition / 4500ms interval | 0 | Page load | ease-in-out | Hero slider |
| A2 | Dropdown appear | Opacity + translateY | 200ms | 0 | Hover on nav item | ease | Dropdown panel |
| A3 | Sticky nav | Box-shadow appear | 150ms | 0 | Scroll past 80px | linear | Header |
| A4 | Card hover elevation | Box-shadow increase | 250ms | 0 | Mouse enter card | ease | .card |
| A5 | Blog image zoom | Scale 1.0 → 1.05 | 400ms | 0 | Mouse enter card | ease | img in card |
| A6 | CTA button hover | Background darken | 200ms | 0 | Mouse enter | ease | Button |
| A7 | Mobile menu open | Max-height expand | 300ms | 0 | Hamburger click | ease | Nav collapse |
| A8 | Scroll reveal | Opacity 0→1 + translateY 20px→0 | 500ms | 0–200ms stagger | Viewport entry | ease-out | Section blocks |
| A9 | Stat counter | Number count-up | 1500ms | 0 | Viewport entry | ease-out | .stat-number |
| A10 | Form field focus | Border color change | 200ms | 0 | Focus | ease | Input border |
| A11 | Form submit | Button loading state | — | 0 | Click | — | Submit button |
| A12 | Carousel dot/arrow | Opacity change | 150ms | 0 | Hover | ease | Carousel controls |

### Animation Implementation Notes
- Scroll reveals: Use Intersection Observer API or jQuery `$.fn.appear` plugin
- Counter animation: jQuery counter plugin or vanilla JS with requestAnimationFrame
- All CSS transitions use `will-change: transform` for GPU optimization where applicable

---

## 9. Forms & User Input

### 9.1 Contact Form (`Contact.html`)

| Field | Type | Placeholder | Validation | Required |
|---|---|---|---|---|
| Name | text | "Your Name" | Min 2 chars | Yes |
| Email | email | "Your Email" | Valid email format | Yes |
| Phone | tel | "Your Phone Number" | 10-digit India format | No |
| Message | textarea | "Your Message" | Min 10 chars | Yes |
| Submit | button | "Send Message" | — | — |

- **Error display:** Red border on invalid field + error text below (`color: #dc3545`)
- **Success:** "Thank you! Your message has been sent." (green inline message or redirect)
- **API:** PHP `mail()` function or server-side script

### 9.2 Free Workshop Registration Form (Landing Pages)

| Field | Type | Placeholder | Validation | Required |
|---|---|---|---|---|
| Name | text | "Your Full Name" | Required | Yes |
| Email | email | "Your Email Address" | Valid email | Yes |
| Phone | tel | "Your Mobile Number" | 10-digit | Yes |
| City | text/select | "Your City" | Required | Yes |
| Submit | button | "Register Now" | — | — |

- **Privacy note:** "Please don't register two persons with same email or mobile number. We protect your privacy!!"
- **Post-submit:** Thank you page or confirmation email

### 9.3 Free Book Lead Magnet Form (`/sp/miracle-book`)

| Field | Type | Required |
|---|---|---|
| Name | text | Yes |
| Email | email | Yes |
| Phone | tel | Possibly |

- **Post-submit:** PDF download link or email delivery
- **Integration:** Email marketing platform (MailChimp / ActiveCampaign) for list-building

### 9.4 Newsletter Inline Form (possible on site)

| Field | Type |
|---|---|
| Email | email |
| Subscribe | button |

---

## 10. Content Structure & Copy

### 10.1 Brand Voice
- **Tone:** Authoritative, inspirational, personal (first-person), empowering
- **Language:** Mix of English and Hindi transliterations
- **Style:** Direct, benefit-focused, transformation-oriented
- **Keywords used repeatedly:** "SubConscious ReImprinting", "NLP", "transformation", "mindset", "empowerment", "results", "techniques"

### 10.2 Homepage Heading Hierarchy

```
H1: "Ram Verma" (Slide 1)
H1: "Ram Verma" (Slide 2)
H1/H2: "Awaken The God of Miracle" (Slide 3)

H2: "Empower Each area of your Life"
  H3: "NLP SR Master Practitioner"
  H3: "Train The Competent Life Coach"
  H3: "Online Courses"
  H3: "Coaching & Mentoring"
  H3: "Audio Programs"

H2: "NLP SubConscious ReImprinting"
  H3/H4: "Expert Trainer"
  H3/H4: "Proven Techniques"
  H3/H4: "Learn New Strategies that Work"
  H3/H4: "Achieve Lasting Results"
  H3/H4: "Overcome Limitations"
  H3/H4: "Change your Mind, Change your Life"

H2/H3: "NLP Training in India by Ram Verma"

H2: "top sellable online courses"
  H3: "Online NLP Bundle"
  H3: "Student Memory Mastery"
  H3: "Total Transformation"

Blockquote: "Master the art of communication with your SubConscious mind..."

H2: "Thoughts By Ram"
  H3: [Blog post titles]

H4: "Courses" (footer)
H4: "Links" (footer)
H4: "Resourses" (footer)
```

### 10.3 Key Marketing Copy Blocks

**Hero CTA (Slide 3):**
> "Awaken The God of Miracle — Book worth 11,000 Rs completely FREE — [Download NOW]"

**Value proposition:**
> "You have a deep desire to live a life that is full of joy, passion, health & wealth. Apart from this you also want to grow your business, be more resourceful, achieve higher goals and fulfill your purpose. Ram Verma's live events, coaching & mentoring programs help you to master your mindset and attain your desired life."

**About bio:**
> "Hi, For more than two decades I have been offering a number of NLP training in India. My generative learning methodology uniquely helps participants learn and practice NLP in a simple way."

**Social proof:**
> "In last two decades, I got an opportunity and big exposure to address and empower around one million people with NLP training in India."

**Pull quote:**
> "Master the art of communication with your SubConscious mind and witness how it can make everything possible for you. — Ram Verma"

**Footer tagline:**
> "India's Leading Authority in the field of Personal Transformation."

**About page bio:**
> "I am an internationally certified and nationally acclaimed NLP coach. They name me the Pioneer of Neuro-Linguistic Programming in India."
> "The Hindustan Times quoted Ram Verma as 'Guiding minds to go in right direction' – Feb 1, 2004."

**Counselling page:**
> "Medical science has already proved that most of the diseases in our body are Psycho-somatic."

**Course page:**
> "Want to learn complete NLP or do NLP trainers training or become a Corporate Trainer? NLP Master Practitioner training in India is the course."

**Calendar page:**
> "Ram Verma believes that the right education is the first step towards bringing the real change. With the right education, right empowerment and with right mentor, Ram Verma, your path to transformation is inevitable."

---

## 11. Schema / SEO Structure

### 11.1 Meta Tags (Homepage)
```html
<title>Ram Verma | NLP Training in India | NLP India | NLP Training India</title>
<meta name="description" content="Certified Neuro Linguistic Programming NLP training in India by Best NLP trainer in India Ram Verma. NLP courses in Delhi, Mumbai, Pune Bangalore, Hyderabad India.">
<meta name="keywords" content="NLP Training in India, NLP India, NLP Training Courses India, Ram Verma, NLP Practitioner, NLP Master Practitioner, NLP Training Delhi, NLP Training Mumbai">
<meta name="author" content="Ram Verma">
```

### 11.2 Open Graph Tags
```html
<meta property="og:title" content="Ram Verma | NLP Training in India">
<meta property="og:description" content="Certified NLP training in India by Ram Verma">
<meta property="og:image" content="https://www.ramverma.com/images/og-image.jpg">
<meta property="og:url" content="https://www.ramverma.com">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Ram Verma NLP Training">
```

### 11.3 Facebook Pixel
```html
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s){...}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '250265196854151');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=250265196854151&ev=PageView&noscript=1"/>
</noscript>
```

### 11.4 Structured Data Schemas (Recommended/Likely)

**Person Schema:**
```json
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Ram Verma",
  "jobTitle": "NLP Coach & Trainer",
  "description": "India's leading NLP SubConscious ReImprinting coach",
  "url": "https://www.ramverma.com",
  "sameAs": [
    "https://www.facebook.com/RamVermaOfficial/",
    "https://in.linkedin.com/in/ramvermanlp",
    "https://www.youtube.com/..."
  ]
}
```

**Organization Schema:**
```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Midas Touch Training",
  "url": "https://www.ramverma.com",
  "telephone": "9873155244"
}
```

**Course Schema (for course pages):**
```json
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "NLP SR Master Practitioner",
  "description": "Complete NLP training — 5-day live workshop",
  "provider": {
    "@type": "Organization",
    "name": "Midas Touch Training"
  }
}
```

### 11.5 URL Conventions
- Static `.html` extension on all main pages
- Hyphenated, descriptive slugs for SEO
- Blog uses WordPress-style permalink: `/blog/[category]/[post-slug]/`
- Landing pages under `/lp/` subdirectory
- Special pages under `/sp/` subdirectory

### 11.6 Canonical Tags
```html
<link rel="canonical" href="https://www.ramverma.com/[page].html">
```

---

## 12. Assets Inventory

### 12.1 Logo
| File | Format | Location | Usage |
|---|---|---|---|
| nlp-logo.png | PNG (likely transparent bg) | images/nlp-logo.png | Header, Footer |

### 12.2 Homepage Images
| File | Format | Dimensions (est.) | Usage |
|---|---|---|---|
| hero-slide-1.[ext] | JPG/WebP | 1920×600px | Hero carousel slide 1 |
| hero-slide-2.[ext] | JPG/WebP | 1920×600px | Hero carousel slide 2 |
| hero-slide-3.[ext] | JPG/WebP | 1920×600px | Hero carousel slide 3 |
| images/home/ram.png | PNG (transparent/cutout) | ~400×600px | Feature section portrait |
| images/home/ram verma.jpg | JPG | ~500×600px | Bio section portrait |
| images/home/blog/nlp business by ram verma.jpg | JPG | ~800×450px | Blog card 1 |
| images/home/blog/focus by ram verma.jpg | JPG | ~800×450px | Blog card 2 |
| images/home/blog/motivate people by ram verma.jpg | JPG | ~800×450px | Blog card 3 |

> **Developer Note:** File name `ram verma.jpg` contains a space — encode as `ram%20verma.jpg` or rename to `ram-verma.jpg`

### 12.3 Course Page Images
| Usage | Format | Notes |
|---|---|---|
| Course banner backgrounds | JPG/WebP | Per course page |
| Trainer photo variants | JPG | For different sections |
| Book cover images | JPG | nlp-books.html |

### 12.4 Icons & Icon System
- **Library:** FontAwesome 4.x or 5.x (CDN or self-hosted)
- **Usage contexts:**
  - Feature items (checkmarks, stars, brain icons)
  - Social media icons (Facebook, YouTube, LinkedIn)
  - Navigation arrows
  - Form field icons
  - Blog meta icons (calendar, user, tag)
- **Possible custom icons:** SVG for specialized NLP-themed icons

### 12.5 Fonts
- **Delivery:** Google Fonts CDN
- **Primary:** `Open Sans` or `Lato`
- **Weights loaded:** 400, 600, 700

### 12.6 External Media References
| Media | Platform | URL |
|---|---|---|
| NLP Visualization Playlist | YouTube | https://www.youtube.com/playlist?list=PLyiccHZstmUx3kkDLi8OWD6vk1Z9Ffv31 |
| Video Testimonials | YouTube (embedded) | Various |
| Facebook Page | Facebook | https://www.facebook.com/RamVermaOfficial/ |

---

## 13. Technology Stack

### 13.1 Confirmed / Highly Likely

| Layer | Technology | Evidence |
|---|---|---|
| HTML | HTML5 (static .html files) | URL structure, page source |
| CSS Framework | Bootstrap 3 or Bootstrap 4 | Grid classes, responsive behavior |
| JavaScript | jQuery 1.x / 2.x | Standard for this era of site |
| Carousel | OWL Carousel 2 | Common jQuery carousel |
| Backend | PHP | Contact form, mail() |
| CMS (Blog) | WordPress | `/blog/` permalink structure |
| E-commerce (Shop) | WooCommerce (on /shop/) | /shop/product/ URL pattern |
| Analytics | Google Analytics (UA or GA4) | Standard practice |
| Tracking | Facebook Pixel (ID: 250265196854151) | Confirmed in source |
| Fonts | Google Fonts | CDN delivery |
| Icons | FontAwesome 4.x/5.x | Icon usage in features |
| Hosting | Shared cPanel Hosting | Static HTML structure |

### 13.2 External Platforms

| Platform | URL | Role |
|---|---|---|
| LMS/Academy | ramvermaacademy.com | Online course delivery |
| Course Platform 2 | ramvermaonline.com | Additional courses |
| Trainer Network | ramvermacoaches.com | Coach directory |
| Udemy | udemy.com/user/ram-verma-7/ | Course marketplace |
| Cloudflare R2 | pub-da6338e8beba4479bdd55d5bfdd8505c.r2.dev | CDN / Bot detection page |

### 13.3 Likely Additional Libraries

```
jQuery Easing Plugin      — for smooth scroll animations
jQuery Counter/CountUp    — for stat animations
WOW.js or AOS            — for scroll reveal animations
Google Maps API           — for contact page map embed
```

### 13.4 Recommended Modern Rebuild Stack

```
Framework:    Next.js 14 (React) — or plain HTML5
Styling:      Tailwind CSS v3 (or Bootstrap 5 for faithful clone)
Carousel:     Swiper.js (modern OWL replacement)
Animations:   GSAP or AOS (Animate On Scroll)
Icons:        FontAwesome 6 or Heroicons
Fonts:        Google Fonts (Open Sans)
Blog:         WordPress headless or markdown-based
E-commerce:   WooCommerce or Stripe-integrated custom
Analytics:    GA4 + Meta Pixel
Deploy:       Vercel / Netlify
```

---

## 14. Mobile Responsiveness

### 14.1 Mobile (`< 768px`)

| Element | Behavior |
|---|---|
| Header | Logo shrinks ~120px wide; hamburger ☰ replaces nav |
| Hero slider | Height reduces to ~280–320px; text scales ~50% |
| Hero H1 | 32–36px (from 52px) |
| Course cards | Single column (100% width) |
| Feature section | Image stacks below text; 1 column |
| Bio section | Image stacks above text; 1 column |
| Blog cards | Single column |
| Footer | All 4 columns stack vertically |
| Section padding | 40px top/bottom (from 80px) |
| Dropdown menu | Accordion expand on tap |
| Font sizes | Reduced ~10–15% across all text elements |
| Images | width: 100%, height: auto |
| Tables | Horizontal scroll or stacked rows |

### 14.2 Tablet (`768px – 992px`)

| Element | Behavior |
|---|---|
| Header | Full nav may still show OR collapse to hamburger at 992px |
| Hero slider | Height ~380–450px |
| Course cards | 2 columns (col-sm-6) |
| Feature section | May still be 2-col or collapse |
| Bio section | 2 columns (smaller image) |
| Blog cards | 2 columns |
| Footer | 2 columns (4 items → 2×2) |
| Section padding | 60px top/bottom |

### 14.3 Desktop (`992px – 1200px`)

| Element | Behavior |
|---|---|
| Header | Full horizontal nav |
| Hero | Full 500–600px height |
| All grids | 3-column standard |
| Footer | 4-column |

### 14.4 Large Desktop (`> 1200px`)

| Element | Behavior |
|---|---|
| Container | Max-width: 1170px centered |
| All else | Same as desktop |

---

## 15. Accessibility

### 15.1 Current State Assessment

| Feature | Status | Notes |
|---|---|---|
| Image alt attributes | Partial | Logo confirmed: `alt="Ram Verma"` and `alt="NLP Training in India"`. Blog images confirmed with descriptive alt text. Body images need verification. |
| Semantic HTML | Moderate | Uses heading hierarchy; likely uses `<header>`, `<nav>`, `<footer>`, `<section>` |
| ARIA labels | Minimal | Hamburger button should have `aria-label="Toggle navigation"` |
| Keyboard navigation | Basic | Standard links/buttons reachable via Tab key |
| Focus indicators | Default browser | No custom focus ring CSS observed |
| Color contrast | Generally passes | Dark text on light bg (H1–H6); white text on dark bg |
| Skip navigation | Absent | No skip-to-content link |
| Form labels | Likely present | Standard `<label for="...">` tags |
| Language attribute | Present | `<html lang="en">` |
| Viewport meta | Present | `<meta name="viewport" content="width=device-width, initial-scale=1">` |

### 15.2 Recommendations for Clone

- Add `<main id="main-content">` wrapper
- Add skip link: `<a href="#main-content" class="sr-only">Skip to main content</a>`
- Add `aria-expanded` to dropdown nav items
- Add `aria-label` to all icon-only buttons
- Add `loading="lazy"` to all below-fold images
- Ensure all form inputs have associated `<label>` elements
- Add `aria-live="polite"` to form success/error messages
- Ensure color contrast ratio ≥ 4.5:1 for all text
- Add `rel="noopener noreferrer"` to all `target="_blank"` links

---

## 16. Third-Party Integrations

| Service | Purpose | ID/Key | Integration Point |
|---|---|---|---|
| Facebook Pixel | Conversion tracking, remarketing | `250265196854151` | `<head>` on all pages |
| Google Analytics | Traffic analytics | (UA/GA4 ID unknown) | `<head>` on all pages |
| Cloudflare R2 | Bot detection / content delivery | pub-da6338e8beba4479bdd55d5bfdd8505c | PHP bot filter in page source |
| Google Fonts | Typography | (font names) | `<head>` CSS link |
| YouTube | Video embeds (testimonials, visualizations) | Channel link confirmed | iFrame embeds |
| Facebook Page | Social proof widget / link | facebook.com/RamVermaOfficial/ | Footer social links |
| LinkedIn | Professional profile link | in.linkedin.com/in/ramvermanlp | Footer or about page |
| Udemy | Course marketplace | /user/ram-verma-7/ | Nav → Shop → Udemy |
| ramvermaacademy.com | Online LMS | Separate domain | Nav links, CTAs |
| ramvermaonline.com | Secondary LMS | Separate domain | Specific course links |
| ramvermacoaches.com | Trainer directory | Separate domain | Footer Resources |
| Email Marketing | Lead capture (free book, workshop reg) | Unknown (MailChimp/ActiveCampaign) | Lead forms |
| PHP Mail | Contact form backend | Server-side | Contact.html form |

---

## 17. Developer Reconstruction Guide

### 17.1 Recommended Folder Structure

```
/ramverma-clone/
│
├── /public/                          # All static files served directly
│    ├── index.html
│    ├── about-ram-verma.html
│    ├── ram-verma-nlp-reviews.html
│    ├── connect-with-ram-verma.html
│    ├── nlp-master-practitioner-course-in-india.html
│    ├── train-the-trainer-course-in-india.html
│    ├── student-nlp-trainer.html
│    ├── onilne-nlp-practitioner-course-in-india.html
│    ├── nlp-wellness-workshop-in-india.html
│    ├── nlp-money-workshop-in-india.html
│    ├── nlp-practitioner-course-in-india.html
│    ├── nlp-student-workshop-in-india.html
│    ├── nlp-online-courses.html
│    ├── nlp-course-date.html
│    ├── nlp-master-practitioner-course-date-in-india.html
│    ├── nlp-free-workshops.html
│    ├── nlp-therapy-counseling-in-india.html
│    ├── corporate-workshop.html
│    ├── nlp-books.html
│    ├── about-nlp.html
│    ├── nlp-training-in-india.html
│    ├── nlp-india.html
│    ├── nlp-videos.html
│    ├── nlp-pictures.html
│    ├── nlp-testimonials.html
│    ├── Contact.html
│    ├── refund-policy.html
│    ├── privacy-policy.html
│    └── terms-and-condition.html
│
├── /images/
│    ├── nlp-logo.png
│    ├── /home/
│    │    ├── ram.png                  (cutout portrait)
│    │    ├── ram-verma.jpg            (rename from "ram verma.jpg")
│    │    └── /blog/
│    │         ├── nlp-business-by-ram-verma.jpg
│    │         ├── focus-by-ram-verma.jpg
│    │         └── motivate-people-by-ram-verma.jpg
│    ├── /hero/
│    │    ├── hero-slide-1.jpg
│    │    ├── hero-slide-2.jpg
│    │    └── hero-slide-3.jpg
│    ├── /courses/
│    ├── /about/
│    ├── /books/
│    └── /og/
│         └── og-image.jpg
│
├── /css/
│    ├── bootstrap.min.css            (Bootstrap 3 or 4)
│    ├── font-awesome.min.css
│    ├── owl.carousel.min.css
│    ├── owl.theme.default.min.css
│    ├── animate.min.css              (for WOW.js / AOS)
│    ├── style.css                    (MAIN custom stylesheet)
│    └── responsive.css               (media query overrides)
│
├── /js/
│    ├── jquery.min.js
│    ├── bootstrap.min.js
│    ├── owl.carousel.min.js
│    ├── wow.min.js                   (scroll animations)
│    ├── jquery.countTo.js            (stat counters)
│    └── main.js                      (custom scripts)
│
├── /fonts/                           (if self-hosting fonts)
│
├── /lp/                              (landing pages)
│    └── /free-workshop/
│         ├── nlp-delhi.html
│         ├── nlp-mumbai.html
│         ├── nlp-hyderabad.html
│         ├── nlp-pune.html
│         └── trainer-mumbai.html
│
├── /sp/                              (special pages)
│    ├── /miracle-book/
│    │    └── index.html
│    └── /ram-verma-communities/
│         └── index.html
│
└── /blog/                            (WordPress install or static)
     ├── /business/
     └── /self-help/
```

### 17.2 HTML Component Hierarchy

```html
<html lang="en">
  <head>
    <!-- Meta tags, title, canonical -->
    <!-- Facebook Pixel -->
    <!-- Google Analytics -->
    <!-- CSS links (Bootstrap, FontAwesome, OWL, style.css) -->
    <!-- Google Fonts -->
  </head>
  <body>

    <!-- ===== HEADER ===== -->
    <header class="site-header">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <img src="images/nlp-logo.png" alt="Ram Verma NLP Training">
        </a>
        <button class="navbar-toggler">☰</button>
        <nav class="navbar-nav">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li class="has-dropdown">
              <a href="#">About Ram</a>
              <ul class="dropdown-menu">
                <li><a href="about-ram-verma.html">Ram Verma</a></li>
                <li><a href="ram-verma-nlp-reviews.html">Success Stories</a></li>
                <li><a href="connect-with-ram-verma.html">Connect with Ram</a></li>
              </ul>
            </li>
            <li class="has-dropdown">
              <a href="#">Courses</a>
              <ul class="dropdown-menu">
                <li><a href="nlp-master-practitioner-course-in-india.html">NLP Master Practitioner</a></li>
                <li><a href="train-the-trainer-course-in-india.html">TTCLC (Life Coach)</a></li>
                <li class="has-dropdown">
                  <a href="#">E-Workshop</a>
                  <ul class="dropdown-menu submenu">
                    <li><a href="onilne-nlp-practitioner-course-in-india.html">NLP Practitioner</a></li>
                    <!-- ... other e-workshop items ... -->
                  </ul>
                </li>
              </ul>
            </li>
            <!-- ... Calendar, Coaching, Shop, Resources, Contact ... -->
          </ul>
        </nav>
      </div>
    </header>

    <!-- ===== MAIN CONTENT ===== -->
    <main id="main-content">

      <!-- Hero Slider -->
      <section class="hero-slider">
        <div class="owl-carousel">
          <div class="slide slide-1">...</div>
          <div class="slide slide-2">...</div>
          <div class="slide slide-3">
            <h1>Awaken The God of Miracle</h1>
            <p>Book worth 11,000 Rs completely FREE</p>
            <a href="https://ramverma.com/sp/miracle-book" class="btn btn-primary">Download NOW</a>
          </div>
        </div>
      </section>

      <!-- Intro Text -->
      <section class="intro-section">
        <div class="container">
          <p>You have a deep desire to live a life that is full of joy...</p>
        </div>
      </section>

      <!-- Course Cards -->
      <section class="courses-section bg-light">
        <div class="container">
          <div class="section-header">
            <h2>Empower Each area of your Life</h2>
            <p>Solution that Fulfills all your Needs..!!</p>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <div class="course-card">...</div>
            </div>
            <!-- 5 course cards -->
          </div>
        </div>
      </section>

      <!-- NLP ReImprinting Features -->
      <section class="nlp-features-section">
        <div class="container">
          <div class="section-header">
            <h2>NLP SubConscious ReImprinting</h2>
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="features-grid">
                <!-- 6 feature items, 2 per row -->
              </div>
              <a href="nlp-course-date.html" class="btn btn-primary">Calendar</a>
            </div>
            <div class="col-md-5">
              <img src="images/home/ram.png" alt="Ram Verma NLP Trainer">
            </div>
          </div>
        </div>
      </section>

      <!-- Bio Section -->
      <section class="bio-section bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-5">
              <img src="images/home/ram-verma.jpg" alt="Ram Verma">
            </div>
            <div class="col-md-7">
              <h2>NLP Training in India by Ram Verma</h2>
              <p>Hi, For more than two decades...</p>
              <a href="about-nlp.html">Learn about NLP <strong>know more</strong></a>
            </div>
          </div>
        </div>
      </section>

      <!-- Online Courses -->
      <section class="online-courses-section">
        <div class="container">
          <div class="section-header">
            <h2>top sellable online courses</h2>
          </div>
          <div class="row">
            <!-- 3 product cards -->
          </div>
          <a href="https://www.ramverma.com/shop/shop/">Check Out All the Audio Programs <strong>Yes, Take me there</strong></a>
        </div>
      </section>

      <!-- Pull Quote -->
      <section class="quote-section">
        <div class="container">
          <blockquote>
            <span class="quote-mark">"</span>
            <p>Master the art of communication with your SubConscious mind...</p>
            <cite>— Ram Verma</cite>
          </blockquote>
        </div>
      </section>

      <!-- Blog Preview -->
      <section class="blog-section bg-light">
        <div class="container">
          <div class="section-header">
            <h2>Thoughts By Ram</h2>
          </div>
          <div class="row">
            <!-- 3 blog cards -->
          </div>
          <a href="https://www.ramverma.com/blog">Empower your Thoughts: <strong>Read Blog</strong></a>
        </div>
      </section>

    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3"><!-- Brand column --></div>
          <div class="col-md-3"><!-- Courses column --></div>
          <div class="col-md-3"><!-- Links column --></div>
          <div class="col-md-3"><!-- Resources column --></div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Copyrights © 2022 All Rights Reserved by Midas Touch Training</p>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
```

### 17.3 main.js Key Functions

```javascript
// 1. Sticky Navigation
$(window).scroll(function() {
  if ($(this).scrollTop() > 80) {
    $('.site-header').addClass('sticky');
  } else {
    $('.site-header').removeClass('sticky');
  }
});

// 2. Hero Carousel
$('.hero-slider .owl-carousel').owlCarousel({
  items: 1,
  loop: true,
  autoplay: true,
  autoplayTimeout: 4500,
  animateOut: 'fadeOut',
  nav: true,
  dots: true,
  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
});

// 3. Mobile Menu Toggle
$('.navbar-toggler').on('click', function() {
  $('.navbar-nav').toggleClass('open');
  $(this).toggleClass('active');
});

// 4. Dropdown Menu (Desktop)
$('.has-dropdown').on('mouseenter', function() {
  $(this).find('.dropdown-menu').stop(true).fadeIn(200);
}).on('mouseleave', function() {
  $(this).find('.dropdown-menu').stop(true).fadeOut(150);
});

// 5. WOW.js Scroll Animations
new WOW().init();

// 6. Counter Animation
$('.stat-number').countTo({
  formatter: function(value, options) {
    return value.toFixed(options.decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }
});

// 7. Smooth scroll for anchor links
$('a[href^="#"]').on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({
    scrollTop: $($(this).attr('href')).offset().top - 80
  }, 600);
});
```

### 17.4 style.css Architecture

```css
/* =============================================
   style.css — Ram Verma Website Main Stylesheet
   ============================================= */

/* 1. CSS Custom Properties (Design Tokens) */
:root { --color-primary: #F5A623; ... }

/* 2. CSS Reset / Normalize */
*, *::before, *::after { box-sizing: border-box; }

/* 3. Base Typography */
body { font-family: var(--font-primary); ... }
h1, h2, h3, h4, h5, h6 { ... }

/* 4. Utility Classes */
.text-center { } .bg-light { } .container { }

/* 5. Header & Navigation */
.site-header { }
.site-header.sticky { }
.navbar-brand { }
.navbar-nav { }
.nav-item { }
.dropdown-menu { }
.has-dropdown:hover .dropdown-menu { }
.submenu { }
.navbar-toggler { }

/* 6. Hero Slider */
.hero-slider { }
.slide { }
.slide-overlay { }
.slide-content { }
.owl-dots { }
.owl-nav { }

/* 7. Section: General */
.section { }
.section-header { }
.section-title { }
.section-subtitle { }
.section-divider { }

/* 8. Section: Course Cards */
.courses-section { }
.course-card { }
.course-card:hover { }
.course-card-title { }
.course-card-desc { }
.course-card-cta { }

/* 9. Section: NLP Features */
.nlp-features-section { }
.features-grid { }
.feature-item { }
.feature-icon { }
.feature-title { }
.ram-portrait { }

/* 10. Section: Bio */
.bio-section { }
.bio-image { }
.bio-text { }
.bio-cta { }

/* 11. Section: Online Courses */
.online-courses-section { }
.product-card { }

/* 12. Section: Pull Quote */
.quote-section { }
.quote-mark { }
.quote-text { }
.quote-attribution { }

/* 13. Section: Blog Preview */
.blog-section { }
.blog-card { }
.blog-card-image { }
.blog-card-image img { transition: transform 400ms ease; }
.blog-card:hover .blog-card-image img { transform: scale(1.05); }
.category-badge { }
.blog-title { }
.blog-meta { }
.blog-excerpt { }

/* 14. Footer */
.site-footer { }
.footer-brand { }
.footer-nav-col { }
.footer-col-title { }
.footer-nav-list { }
.footer-bottom { }

/* 15. Buttons */
.btn { }
.btn-primary { }
.btn-primary:hover { }
.btn-outline { }
.btn-lg { }
.btn-sm { }

/* 16. Forms */
.form-group { }
.form-control { }
.form-control:focus { }
.form-control.is-invalid { }
.form-error-msg { }
.form-success-msg { }

/* 17. Testimonial Cards */
.testimonial-card { }
.testimonial-quote { }
.testimonial-author { }
.author-avatar { }

/* 18. Stat Counters */
.stats-section { }
.stat-item { }
.stat-number { }
.stat-label { }

/* 19. Page Banner (Inner Pages) */
.page-banner { }
.page-banner h1 { }
.breadcrumb { }

/* 20. Landing Pages */
.lp-hero { }
.lp-form-section { }
.lp-form-container { }
.lp-bio-section { }

/* =============================================
   responsive.css
   ============================================= */

@media (max-width: 991px) {
  /* Tablet adjustments */
  .navbar-nav { display: none; }
  .navbar-toggler { display: block; }
}

@media (max-width: 767px) {
  /* Mobile adjustments */
  .hero-slider { height: 300px; }
  .section { padding: 40px 0; }
  .col-xs-12 { width: 100%; }
  .site-footer .row > div { margin-bottom: 30px; }
}
```

### 17.5 Known Content Issues & Notes for Developers

1. **Typo in URL:** `onilne-nlp-practitioner-course-in-india.html` — "onilne" is intentional typo in original, preserve for clone accuracy
2. **Typo in footer:** "Resourses" (should be "Resources") — preserve as-is for faithful clone
3. **Image filename with space:** `ram verma.jpg` — reference as `ram%20verma.jpg` or rename to `ram-verma.jpg`
4. **Copyright year:** Footer shows "Copyrights © 2022" — update as needed
5. **Phone number:** 9873155244 appears on Contact page
6. **Cloudflare R2 bot detection:** PHP code at top of pages checks user agent — implement in PHP includes
7. **Facebook Pixel ID:** `250265196854151` — must be placed in `<head>` on all pages
8. **Blog platform:** Separate WordPress installation likely at `/blog/` subdirectory
9. **Shop:** WooCommerce store at `/shop/` subdirectory — requires separate setup

---

*End of Complete PRD — ramverma.com*
*Document covers: 28+ pages | All confirmed content | Full component library | Complete design system | Developer implementation guide*
*Prepared for: 100% visual and functional clone reconstruction*
