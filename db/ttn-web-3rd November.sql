-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2019 at 10:51 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ttn-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_points`
--

CREATE TABLE `access_points` (
  `id` int(11) NOT NULL,
  `access_point_name` varchar(200) NOT NULL,
  `unique_code` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='The list of access points for various users';

-- --------------------------------------------------------

--
-- Table structure for table `access_points_users`
--

CREATE TABLE `access_points_users` (
  `id` int(11) NOT NULL,
  `access_point_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_starts_at` datetime DEFAULT NULL,
  `access_ends_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List of granted access to a specific group of users';

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL COMMENT 'When user accomplished a training here',
  `badge_id` int(11) DEFAULT NULL COMMENT 'When user accomplished a training here',
  `achievement_title` varchar(200) NOT NULL,
  `achievement_year` int(11) DEFAULT NULL,
  `institute` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_point_id` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `access_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various user activity logs';

-- --------------------------------------------------------

--
-- Table structure for table `ad_categories`
--

CREATE TABLE `ad_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `descr` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Like Yarn, Machineries, Service regarding production etc';

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `up_vote` int(11) NOT NULL DEFAULT '0',
  `down_vote` int(11) NOT NULL DEFAULT '0',
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL COMMENT 'Draft, published etc',
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Answers of various questions';

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `platform_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Platform 1 meang google play',
  `package_name` varchar(100) NOT NULL,
  `short_descr` varchar(250) NOT NULL,
  `descr` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `promo_video_link` varchar(250) DEFAULT NULL,
  `firebase_token` text,
  `created_at` int(11) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mobile apps';

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `color_code` varchar(12) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `score_needed` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Yellow belt, green belt, black etc';

-- --------------------------------------------------------

--
-- Table structure for table `badges_users`
--

CREATE TABLE `badges_users` (
  `badge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User can have multiple badges like Moderator, Contributor et';

-- --------------------------------------------------------

--
-- Table structure for table `billing_info`
--

CREATE TABLE `billing_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `partial_card_no` varchar(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User may have multiple cards, multiple type of cards to pay';

-- --------------------------------------------------------

--
-- Table structure for table `certificates_discarded`
--

CREATE TABLE `certificates_discarded` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `classes_discarded`
--

CREATE TABLE `classes_discarded` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL DEFAULT '1',
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `venue` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various classes of a training';

-- --------------------------------------------------------

--
-- Table structure for table `classifieds`
--

CREATE TABLE `classifieds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_category_id` int(11) NOT NULL COMMENT 'Tools, Machinaries, Yarn etc',
  `organization_id` int(11) DEFAULT NULL,
  `ad_type_id` int(11) NOT NULL COMMENT 'Featured, Premium etc',
  `ad_position_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `details` text,
  `impression_starts_at` datetime NOT NULL,
  `impression_ends_at` datetime NOT NULL,
  `is_service` tinyint(1) NOT NULL DEFAULT '0',
  `is_selling` tinyint(1) NOT NULL DEFAULT '1',
  `total_like` int(11) NOT NULL DEFAULT '0',
  `total_click` int(11) NOT NULL DEFAULT '0',
  `total_views` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ads/Classifieds posted by users or organizations';

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_interest_groups`
--

CREATE TABLE `classifieds_interest_groups` (
  `classified_id` int(11) NOT NULL,
  `interest_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Classifieds may suit for various interest groups';

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `classified_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Reply of a comment will have parent id which is the comment id',
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_discarded`
--

CREATE TABLE `courses_discarded` (
  `id` int(11) NOT NULL COMMENT ' ',
  `certificate_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `course_fee` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `maximum_student` int(11) NOT NULL DEFAULT '30',
  `is_mendatory` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses_users_discarded`
--

CREATE TABLE `courses_users_discarded` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `certificate_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `enrolled_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `degree_name` varchar(200) NOT NULL,
  `institute_name` varchar(200) NOT NULL,
  `passing_year` int(11) NOT NULL,
  `cgpa` varchar(15) DEFAULT NULL,
  `created_ad` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `template_title` varchar(250) NOT NULL,
  `template_code` varchar(100) NOT NULL,
  `email_subject` text NOT NULL,
  `email_body` text NOT NULL,
  `email_from` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various email templates';

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Who is creating the event',
  `event_type_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `venue` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `contact_phone_no` varchar(20) NOT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List of all the events';

-- --------------------------------------------------------

--
-- Table structure for table `events_interest_groups`
--

CREATE TABLE `events_interest_groups` (
  `event_id` int(11) NOT NULL,
  `interest_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User of a specific interest group will see related event';

-- --------------------------------------------------------

--
-- Table structure for table `events_users`
--

CREATE TABLE `events_users` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='All the users and their update joining an event';

-- --------------------------------------------------------

--
-- Table structure for table `event_sessions`
--

CREATE TABLE `event_sessions` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `descr` text NOT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime DEFAULT NULL,
  `speaker_id` int(11) NOT NULL,
  `is_keynote_speaker` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `type_code` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `firebase_tokens`
--

CREATE TABLE `firebase_tokens` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `firebase_token` varchar(250) NOT NULL,
  `last_sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `flag_by` int(11) NOT NULL,
  `flagging_reason` text NOT NULL,
  `flagged_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Group, Page, post can be flagged by users';

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `about_the_group` text,
  `rules_to_join` text,
  `security_question` text,
  `answer` text,
  `moto` varchar(250) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `banner` varchar(200) DEFAULT NULL,
  `total_member` int(11) NOT NULL DEFAULT '1',
  `total_post` int(11) NOT NULL DEFAULT '0',
  `total_flag` int(11) NOT NULL DEFAULT '0',
  `website` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Custom group created by users';

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

CREATE TABLE `groups_users` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL COMMENT 'Options will be coming from config',
  `user_status` int(11) NOT NULL,
  `joined_at` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users of a group is managed here';

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `app_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `caption` text,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `interest_groups`
--

CREATE TABLE `interest_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `group_code` varchar(50) NOT NULL,
  `descr` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `interest_groups_jobs`
--

CREATE TABLE `interest_groups_jobs` (
  `interest_group_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Job poster may want to reach users of specific interest grp';

-- --------------------------------------------------------

--
-- Table structure for table `interest_groups_posts`
--

CREATE TABLE `interest_groups_posts` (
  `interest_group_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Posts of a specific interest group will be shown to user';

-- --------------------------------------------------------

--
-- Table structure for table `interest_groups_training`
--

CREATE TABLE `interest_groups_training` (
  `interest_group_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `invited_by` int(11) NOT NULL,
  `invited_to` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `is_notification_seen` tinyint(4) NOT NULL DEFAULT '0',
  `invited_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Invitations to page, group or someting else';

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Who posted the job',
  `job_type_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `job_location` varchar(100) NOT NULL,
  `total_vacancy` int(11) NOT NULL DEFAULT '1',
  `application_deadline` date NOT NULL,
  `salary_range` varchar(200) NOT NULL,
  `minimum_experience` int(11) DEFAULT NULL,
  `maximum_experience` int(11) DEFAULT NULL,
  `minimum_age` int(11) DEFAULT NULL,
  `maximum_age` int(11) DEFAULT NULL,
  `prefered_gender` int(11) DEFAULT NULL,
  `responsibilities` text NOT NULL,
  `requirements` text NOT NULL,
  `other_benefits` text NOT NULL,
  `special_instruction` text,
  `total_views` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_users`
--

CREATE TABLE `jobs_users` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `is_notified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Those who applied for the job';

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `descr` text,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various job types, full time, part time, contract etc';

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `language_code` varchar(10) NOT NULL,
  `native_name` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages_users`
--

CREATE TABLE `languages_users` (
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User may have various language proficiency';

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `is_creator_notified` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Who created the job, post, events',
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `liked_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mentors`
--

CREATE TABLE `mentors` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_topic` varchar(250) NOT NULL,
  `total_class` int(11) NOT NULL DEFAULT '1',
  `class_taken` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Trainers of a training/course';

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message_from` int(11) NOT NULL,
  `message_to` int(11) NOT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` text NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Inbox messages received from other users';

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `img_url` varchar(250) DEFAULT NULL,
  `total_sent` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_users`
--

CREATE TABLE `notifications_users` (
  `id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_notified` tinyint(1) NOT NULL DEFAULT '0',
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `notified_at` datetime NOT NULL,
  `seen_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='System generated notifications';

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `short_details` text NOT NULL,
  `website` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `company_logo` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Usually jobs will be posted for organizations';

-- --------------------------------------------------------

--
-- Table structure for table `organizations_users`
--

CREATE TABLE `organizations_users` (
  `id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `descr` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Who will be responsible for job posting on behalf of org ';

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `page_category_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `about` text,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `banner` varchar(200) NOT NULL,
  `total_like` int(11) NOT NULL DEFAULT '0',
  `total_follow` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `starts_at` date NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various pages created by users';

-- --------------------------------------------------------

--
-- Table structure for table `pages_users`
--

CREATE TABLE `pages_users` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_liked` tinyint(1) NOT NULL DEFAULT '0',
  `is_following` tinyint(1) NOT NULL DEFAULT '0',
  `liked_at` datetime DEFAULT NULL,
  `following_from` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User can follow or like many pages';

-- --------------------------------------------------------

--
-- Table structure for table `page_categories`
--

CREATE TABLE `page_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `unique_code` varchar(100) NOT NULL,
  `descr` text NOT NULL COMMENT 'Short Details',
  `applicable_from` date NOT NULL COMMENT 'From when policy is applicable',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `policy_details`
--

CREATE TABLE `policy_details` (
  `id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `section_name` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `mentionable_link` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_type_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `descr` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `total_like` int(11) NOT NULL DEFAULT '0',
  `total_share` int(11) NOT NULL DEFAULT '0',
  `total_comment` int(11) NOT NULL DEFAULT '0',
  `total_views` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_types`
--

CREATE TABLE `post_types` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `type_code` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `question_category_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `is_faq` tinyint(1) NOT NULL DEFAULT '0',
  `up_vote` int(11) NOT NULL DEFAULT '0',
  `down_vote` int(11) NOT NULL DEFAULT '0',
  `total_flag` int(11) NOT NULL DEFAULT '0',
  `total_view` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Queries by the site and from other users';

-- --------------------------------------------------------

--
-- Table structure for table `question_categories`
--

CREATE TABLE `question_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `descr` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `total_questions` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resources_discarded`
--

CREATE TABLE `resources_discarded` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `descr` text,
  `resource_path` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='A training or class can have multiple resources like ppt,pdf';

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descr` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `service_code` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various services provided by this application';

-- --------------------------------------------------------

--
-- Table structure for table `services_user_types`
--

CREATE TABLE `services_user_types` (
  `service_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Specific user group may have access to various services';

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `code_name` varchar(200) NOT NULL,
  `code_label` varchar(250) NOT NULL,
  `code_value` text NOT NULL,
  `code_descr` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_notified` tinyint(1) NOT NULL DEFAULT '0',
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `shared_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skills_users`
--

CREATE TABLE `skills_users` (
  `skill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_category_id` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various tags';

-- --------------------------------------------------------

--
-- Table structure for table `tag_categories`
--

CREATE TABLE `tag_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various tag categories';

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `training_code` varchar(100) NOT NULL,
  `details` text,
  `duration` varchar(200) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `discount` float DEFAULT '0',
  `starts_at` datetime NOT NULL,
  `ends_at` datetime DEFAULT NULL,
  `registration_deadline` datetime NOT NULL,
  `contact_phone_no` varchar(20) DEFAULT NULL,
  `alternate_contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `alternate_contact_email` varchar(150) DEFAULT NULL,
  `total_views` int(11) NOT NULL DEFAULT '0',
  `total_flag` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `training_categories`
--

CREATE TABLE `training_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `descr` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Training on various topics or subjects';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alternate_phone` varchar(20) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `password_token` varchar(250) NOT NULL,
  `token_sent_at` datetime DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `post_code` varchar(15) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `about_yourself` text,
  `billing_address` varchar(250) DEFAULT NULL,
  `alternate_billing_address` varchar(250) DEFAULT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `background_banner` varchar(250) DEFAULT NULL,
  `facebook_link` varchar(250) DEFAULT NULL,
  `twitter_link` varchar(250) DEFAULT NULL,
  `linkedin_link` varchar(250) DEFAULT NULL,
  `instagram_link` varchar(250) DEFAULT NULL,
  `youtube_link` varchar(250) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `resume` varchar(200) DEFAULT NULL COMMENT 'Uploaded Resume',
  `total_questions` int(11) NOT NULL DEFAULT '0',
  `total_answers` int(11) NOT NULL DEFAULT '0',
  `total_score` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='All the users like, admin and subscribers etc..';

-- --------------------------------------------------------

--
-- Table structure for table `users_connections`
--

CREATE TABLE `users_connections` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `connection_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='All the users connections/friends';

-- --------------------------------------------------------

--
-- Table structure for table `users_interest_groups`
--

CREATE TABLE `users_interest_groups` (
  `interest_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_user_types`
--

CREATE TABLE `users_user_types` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `descr` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `file` varchar(200) NOT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `caption` text,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `source_ip` varchar(30) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `classified_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='To get the uniques visitor of a section or page';

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `classified_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Various favorite or following list of a user';

-- --------------------------------------------------------

--
-- Table structure for table `working_histories`
--

CREATE TABLE `working_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `job_title` varchar(150) NOT NULL,
  `responsibilities` text,
  `joined_at` datetime NOT NULL,
  `left_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_points`
--
ALTER TABLE `access_points`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_code` (`unique_code`);

--
-- Indexes for table `access_points_users`
--
ALTER TABLE `access_points_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_categories`
--
ALTER TABLE `ad_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `billing_info`
--
ALTER TABLE `billing_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates_discarded`
--
ALTER TABLE `certificates_discarded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes_discarded`
--
ALTER TABLE `classes_discarded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds`
--
ALTER TABLE `classifieds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_discarded`
--
ALTER TABLE `courses_discarded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_users_discarded`
--
ALTER TABLE `courses_users_discarded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_code` (`template_code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_users`
--
ALTER TABLE `events_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_sessions`
--
ALTER TABLE `event_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firebase_tokens`
--
ALTER TABLE `firebase_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `firebase_token` (`firebase_token`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_users`
--
ALTER TABLE `groups_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest_groups`
--
ALTER TABLE `interest_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_code` (`group_code`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_users`
--
ALTER TABLE `jobs_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `language_code` (`language_code`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_users`
--
ALTER TABLE `notifications_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations_users`
--
ALTER TABLE `organizations_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_category_id` (`page_category_id`);

--
-- Indexes for table `pages_users`
--
ALTER TABLE `pages_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_categories`
--
ALTER TABLE `page_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_code` (`unique_code`);

--
-- Indexes for table `policy_details`
--
ALTER TABLE `policy_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_types`
--
ALTER TABLE `post_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_code` (`type_code`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_categories`
--
ALTER TABLE `question_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources_discarded`
--
ALTER TABLE `resources_discarded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_code` (`service_code`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_categories`
--
ALTER TABLE `tag_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `training_code` (`training_code`);

--
-- Indexes for table `training_categories`
--
ALTER TABLE `training_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `users_connections`
--
ALTER TABLE `users_connections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_histories`
--
ALTER TABLE `working_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_points`
--
ALTER TABLE `access_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `access_points_users`
--
ALTER TABLE `access_points_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_categories`
--
ALTER TABLE `ad_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_info`
--
ALTER TABLE `billing_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates_discarded`
--
ALTER TABLE `certificates_discarded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes_discarded`
--
ALTER TABLE `classes_discarded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classifieds`
--
ALTER TABLE `classifieds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses_discarded`
--
ALTER TABLE `courses_discarded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ';

--
-- AUTO_INCREMENT for table `courses_users_discarded`
--
ALTER TABLE `courses_users_discarded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events_users`
--
ALTER TABLE `events_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_sessions`
--
ALTER TABLE `event_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firebase_tokens`
--
ALTER TABLE `firebase_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups_users`
--
ALTER TABLE `groups_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interest_groups`
--
ALTER TABLE `interest_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs_users`
--
ALTER TABLE `jobs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications_users`
--
ALTER TABLE `notifications_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations_users`
--
ALTER TABLE `organizations_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages_users`
--
ALTER TABLE `pages_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_categories`
--
ALTER TABLE `page_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_details`
--
ALTER TABLE `policy_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_types`
--
ALTER TABLE `post_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_categories`
--
ALTER TABLE `question_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources_discarded`
--
ALTER TABLE `resources_discarded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag_categories`
--
ALTER TABLE `tag_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_categories`
--
ALTER TABLE `training_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_connections`
--
ALTER TABLE `users_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_histories`
--
ALTER TABLE `working_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
