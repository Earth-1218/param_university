-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2025 at 03:37 PM
-- Server version: 8.0.30
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `param_university`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddAutoIncrementToId` ()   BEGIN
    -- Declare variables
    DECLARE done INT DEFAULT 0;
    DECLARE table_name VARCHAR(255);
    DECLARE column_name VARCHAR(255) DEFAULT 'id';
    DECLARE cur CURSOR FOR
        SELECT DISTINCT table_name
        FROM information_schema.columns
        WHERE table_schema = 'param_university'
          AND column_name = column_name;

    -- Declare the continue handler for the cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Open the cursor
    OPEN cur;

    -- Loop through all the tables
    read_loop: LOOP
        FETCH cur INTO table_name;
        
        -- If no more rows, exit the loop
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Alter the table to add AUTO_INCREMENT to the 'id' column
        SET @sql = CONCAT('ALTER TABLE ', table_name, ' MODIFY COLUMN ', column_name, ' INT AUTO_INCREMENT');
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END LOOP;

    -- Close the cursor
    CLOSE cur;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `book_id` int NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `fine` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `tenure` enum('1 year','2 years','3 years','4 years','others') DEFAULT 'others',
  `semester` enum('2','4','6','8') DEFAULT '6',
  `fees` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `name`, `tenure`, `semester`, `fees`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 0, 'BCA', '2 years', '4', 45300, '2025-01-12 03:45:51', '2025-01-12 03:45:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `remarks` text,
  `date` date NOT NULL,
  `payment_instrument` enum('online','cash') DEFAULT 'cash',
  `payment_through` enum('RTGS','NEFT','IMPS','UPI','CASH') DEFAULT 'CASH',
  `payment_ref_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `start` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `organizer` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_assets`
--

CREATE TABLE `event_assets` (
  `id` int NOT NULL,
  `event_id` varchar(255) NOT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `remarks` text,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `course_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `start` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` time NOT NULL,
  `total_marks` int DEFAULT '100',
  `passing_marks` int DEFAULT '40',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_papers`
--

CREATE TABLE `exam_papers` (
  `id` int NOT NULL,
  `exam_id` int NOT NULL,
  `paper` varchar(255) DEFAULT NULL,
  `paper_set` enum('A','B','C','D') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `marks_obtained` int NOT NULL,
  `status` enum('pass','fail') DEFAULT 'fail',
  `remarks` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int NOT NULL,
  `category` enum('electricity','salary_payment','stationary','repairing','traveling','food','cleaning','renovation','fire_and_safety','medical','others') DEFAULT 'others',
  `remarks` text,
  `date` date NOT NULL,
  `payment_instrument` enum('online','cash') DEFAULT 'cash',
  `payment_through` enum('RTGS','NEFT','IMPS','UPI','CASH') DEFAULT 'CASH',
  `payment_ref_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int NOT NULL,
  `course_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `dob` date NOT NULL,
  `merital_status` enum('married','unmarried') DEFAULT 'unmarried',
  `designation` enum('professor','proxy_professor') DEFAULT 'professor',
  `about` text,
  `joining_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `departure_date` timestamp NULL DEFAULT NULL,
  `experience` enum('1 year','2 years','3 years','4 years','others') DEFAULT 'others',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_attendance`
--

CREATE TABLE `faculty_attendance` (
  `id` int NOT NULL,
  `faculty_id` int NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','leave') DEFAULT 'present',
  `leave_reason` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int NOT NULL,
  `occupied` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int NOT NULL,
  `sponsor_id` int DEFAULT '0',
  `category` enum('donation','fees','others') DEFAULT 'fees',
  `remarks` text,
  `date` date NOT NULL,
  `payment_instrument` enum('online','cash') DEFAULT 'cash',
  `payment_through` enum('RTGS','NEFT','IMPS','UPI','CASH') DEFAULT 'CASH',
  `payment_ref_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int NOT NULL,
  `faculty_id` int NOT NULL,
  `course_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `lesson_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int NOT NULL,
  `subject_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `description` text,
  `notes` longtext,
  `downloadable_pdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library_books`
--

CREATE TABLE `library_books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `available` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management_team`
--

CREATE TABLE `management_team` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `dob` date NOT NULL,
  `about` text,
  `department` enum('president','hod','trustee','dean','admin','accountant','librarian','clerk','guard','others') DEFAULT 'others',
  `joining_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `enrollment_no` varchar(255) DEFAULT NULL,
  `course_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `aadhaar_no` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `dob` date NOT NULL,
  `about` text,
  `merital_status` enum('married','unmarried') DEFAULT 'unmarried',
  `joining_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `departure_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `enrollment_no`, `course_id`, `name`, `father_name`, `mother_name`, `aadhaar_no`, `mobile_no`, `email`, `gender`, `dob`, `about`, `merital_status`, `joining_date`, `departure_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '928059', 10, 'Junior Nitzsche Jr.', 'Ms. Hattie Herzog MD', 'Arvilla Lebsack DVM', '705809829220', '(401) 299-4946', 'lexie.simonis@example.com', 'female', '1989-05-23', 'Corporis quam dolorem est unde. Nulla repudiandae nisi tempore quis itaque quibusdam. Enim debitis aut accusamus et optio. Consectetur ut iure sit debitis eum.', 'unmarried', '2013-03-12 18:30:00', '2013-03-21 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(4, '995813', 7, 'Sonia Olson', 'Hailie Torp', 'Prof. Bradley Roberts', '685449308353', '731-356-0239', 'brisa.zboncak@example.net', 'male', '1996-07-02', 'Labore cumque maxime nostrum voluptatem. Voluptate mollitia aut sint. Doloribus sapiente temporibus ad sint sint error. Id voluptatibus non placeat perspiciatis.', 'unmarried', '1981-04-10 18:30:00', '1986-09-27 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(7, '751987', 7, 'Diamond Beatty', 'Mrs. Janessa McKenzie', 'Gerardo Abbott', '487908864963', '+1 (217) 267-7696', 'robyn19@example.com', 'female', '1989-03-25', 'Omnis cumque optio facilis illo repudiandae et qui. Dolores expedita voluptas veritatis dolores dicta explicabo eos nobis. Sed est ut eaque architecto eligendi nisi et. Et aperiam eius numquam ab aut similique similique.', 'unmarried', '2015-10-01 18:30:00', '2022-10-20 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(8, '656186', 5, 'Dr. Jermey Klocko', 'Jabari Champlin', 'Stewart Klocko', '871182027199', '1-270-384-4657', 'king53@example.com', 'male', '1983-11-30', 'Fugiat accusantium repellat in ut sed sunt eum. Earum ad quia ut et qui. Ducimus at laboriosam architecto ut. Voluptatibus quia quibusdam doloribus quidem tempora sed unde animi.', 'married', '2010-09-18 18:30:00', '1994-01-07 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(9, '595303', 10, 'Clovis Swaniawski', 'Frida Collier', 'Kariane Johnson', '308964807784', '(551) 788-9680', 'koss.frederick@example.net', 'male', '2005-07-18', 'Quaerat non velit in doloribus assumenda aspernatur. Tempora ducimus debitis quidem reprehenderit laudantium quibusdam dolorum. Laboriosam corrupti distinctio et ratione similique enim labore. Ullam ut ut sit.', 'married', '2009-04-07 18:30:00', '2010-08-17 18:30:00', '2025-01-10 07:38:03', '2025-01-11 23:51:50', NULL),
(10, '789300', 9, 'Antone Kertzmann MD', 'Prof. Kaitlyn Hansen', 'Shana Schumm', '243187778097', '(320) 863-3689', 'erdman.keeley@example.org', 'male', '1979-06-10', 'Odit voluptatum totam facilis ipsum hic. Laudantium aperiam vitae perspiciatis illum cumque. Error mollitia voluptas corporis placeat architecto.', 'married', '2017-02-12 18:30:00', '1982-12-20 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(11, '675129', 6, 'Mrs. Eryn Schumm DVM', 'Mr. Domenico Rempel I', 'Octavia Beier', '530343925107', '+1.380.410.3711', 'simonis.eda@example.net', 'male', '2004-02-03', 'Commodi quam eligendi porro eligendi sint accusantium itaque. Laborum occaecati laboriosam praesentium perferendis doloribus. Natus aut consequatur laborum nesciunt in velit amet tempora. Fuga delectus pariatur aut similique sit earum ipsa.', 'unmarried', '2021-12-25 18:30:00', '1991-08-10 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(12, '903500', 8, 'Edwina Nicolas', 'Charlotte Nicolas', 'Bette Heidenreich', '216970519777', '(563) 882-8965', 'carlo.dicki@example.net', 'male', '1978-08-11', 'Temporibus illum maiores nihil eos nihil. Explicabo sequi temporibus excepturi dicta qui officia. Nulla nostrum et reprehenderit voluptates. Ut aliquid nam mollitia veritatis voluptates iure.', 'married', '2004-06-29 18:30:00', '2019-09-27 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(13, '910966', 7, 'Dudley Kovacek', 'Sherman Watsica', 'Forest Mayer', '138597581175', '+1 (765) 377-1666', 'lois70@example.com', 'female', '2005-12-05', 'Et perspiciatis nihil odio sed officia nemo illo repellendus. Explicabo rem quia et libero nostrum. Labore dolor ut recusandae sit est ut.', 'married', '2008-12-04 18:30:00', '1976-08-15 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(14, '881317', 8, 'Hettie Langworth', 'Mauricio Shanahan', 'Lewis Muller Sr.', '203373330517', '+1 (980) 432-5228', 'jones.conner@example.org', 'female', '1983-10-01', 'Et in delectus in beatae veritatis consequatur beatae quia. Nesciunt ipsam occaecati fuga quo. Inventore impedit voluptas iure nisi et. Sunt vel nisi consectetur quasi mollitia quaerat laboriosam.', 'married', '1980-09-03 18:30:00', '1972-04-02 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(15, '929953', 6, 'Vito Klocko V', 'Mariela Rice', 'Gabe Upton', '123660313199', '+1-276-766-9952', 'dooley.maribel@example.org', 'female', '1986-07-13', 'Dolorem voluptate est rerum eum dignissimos aliquam esse. Eveniet amet est ex. Et modi eum nulla earum nam quaerat autem exercitationem.', 'married', '2022-06-01 18:30:00', '2021-09-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(16, '765925', 5, 'Nola Cummings', 'Mrs. Jordane Koch MD', 'Arlo Flatley V', '837663065635', '+1-908-380-0487', 'juliana.senger@example.com', 'male', '2003-02-01', 'A nulla omnis soluta et id iusto eum dolorem. Fuga accusantium sunt incidunt. Aliquam possimus ullam ut voluptatem incidunt.', 'married', '1992-06-20 18:30:00', '1979-06-28 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(17, '623446', 9, 'Matilde Mueller', 'Roselyn Kunde', 'Mr. Kale Swift', '142923658599', '878.379.6119', 'owilderman@example.com', 'male', '1989-07-12', 'Tempora sint vero rem consequuntur necessitatibus impedit ullam laborum. Delectus earum aliquam sit quos cum. Eum perferendis recusandae commodi.', 'married', '1998-02-22 18:30:00', '2020-01-06 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(18, '725230', 7, 'Lafayette Swaniawski', 'Dock Feeney', 'Miss Meaghan Wehner DVM', '521142946204', '361-531-5219', 'cristina.prohaska@example.net', 'female', '1989-02-25', 'Laborum voluptatem mollitia adipisci culpa deserunt ut doloremque. Quis qui nemo perferendis ab debitis voluptatem voluptatibus voluptas. Dolorum sed veniam sunt ducimus at. Non eos incidunt tempora illum nemo totam sequi.', 'married', '1994-01-29 18:30:00', '1984-11-16 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(19, '782639', 10, 'Prof. Wilbert Stiedemann V', 'Mr. Sigmund Cummerata DVM', 'Shawn Carter II', '167798271114', '+1-715-386-1802', 'corwin.judd@example.org', 'female', '1977-02-26', 'Voluptas consequatur voluptas facilis eos laboriosam expedita. Architecto incidunt cupiditate aut ducimus. Quisquam aliquam iure corrupti voluptates error quia. Qui atque qui voluptas.', 'married', '2014-09-02 18:30:00', '2011-01-09 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(20, '155917', 8, 'Sofia Kessler', 'Janick Green V', 'Ambrose Mohr', '810864001644', '+1 (231) 692-8772', 'cummings.queenie@example.org', 'female', '1994-07-21', 'Nulla excepturi tempore iste modi est hic labore. Aliquid animi tenetur aut error. Libero qui repellendus officiis. Facilis voluptatem voluptatem ut doloribus.', 'unmarried', '1971-12-31 18:30:00', '1974-07-18 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(21, '881262', 5, 'Mrs. Alvena Dickens', 'Julie O\'Keefe', 'Roger Kerluke', '695892515771', '+1.480.504.5166', 'yromaguera@example.org', 'female', '1993-04-25', 'Sapiente illo eum consequuntur voluptate rerum. Recusandae sequi qui perspiciatis qui eum. Ducimus eaque voluptatem earum quia est rerum quod non. Vel nesciunt quae dolores non.', 'unmarried', '1971-02-25 18:30:00', '2013-05-19 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(22, '638767', 2, 'Jesse Keeling', 'Linwood Breitenberg', 'Ms. Leta Roob Jr.', '971181611271', '+1-423-853-3352', 'dlegros@example.net', 'female', '1972-04-12', 'Nam nobis praesentium deleniti quod. Quaerat ut est fuga incidunt id.', 'married', '2018-02-10 18:30:00', '2023-06-23 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(23, '276257', 8, 'Ms. Melba Kuhn', 'Stone Lakin', 'Dr. Jessyca Gusikowski', '882145659303', '+1.432.916.2468', 'ykris@example.org', 'male', '2004-04-06', 'Explicabo natus illo sed dolore esse ipsa culpa. Voluptatem molestiae facilis voluptatem qui enim vel. Quia aut ea quasi consequatur.', 'unmarried', '2022-12-18 18:30:00', '2019-07-17 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(24, '103170', 7, 'Alexandria Gerhold', 'Dean Ankunding', 'Clementina Spencer', '762853482665', '567-653-6987', 'misael.rice@example.net', 'male', '1996-05-27', 'Odit et repudiandae aut sed vel. Mollitia optio molestiae laborum recusandae dicta ipsum. Nam similique officiis nesciunt ut.', 'married', '1983-02-09 18:30:00', '2006-03-06 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(25, '333523', 7, 'Amanda Bernier', 'Esperanza Pacocha', 'Tina Towne', '246467047157', '+18207476613', 'ibashirian@example.com', 'male', '1974-05-05', 'Porro facere nulla cupiditate reprehenderit quia ipsam. Corrupti aut quis eum rerum amet eum quis deleniti. Placeat rerum debitis dolor sit. Totam at excepturi necessitatibus occaecati similique.', 'married', '2013-12-24 18:30:00', '1974-01-27 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(26, '118850', 2, 'Jaclyn Larkin', 'Dr. Olaf Nienow', 'Aiyana Grant MD', '855813857660', '929-322-1582', 'bayer.charley@example.com', 'male', '1986-01-28', 'Ut exercitationem aspernatur consequatur. Impedit laborum quo repellat esse. Et praesentium sequi optio quod. Id accusamus tenetur vel animi perferendis non officia fuga.', 'unmarried', '2017-09-02 18:30:00', '2011-04-26 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(27, '591908', 8, 'Priscilla Schmeler', 'Prof. Keanu Heaney', 'Mr. Francesco Ortiz', '128352542252', '+1-937-654-5402', 'patsy49@example.org', 'male', '1984-05-07', 'Magnam laborum ipsum odio illum error eum. Eos officiis dolore nam minus est omnis. Quae architecto blanditiis mollitia et.', 'unmarried', '1974-10-13 18:30:00', '2008-11-15 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(28, '646581', 9, 'Mr. Ethan O\'Hara PhD', 'Tara Bosco', 'Ms. Neva Kuphal', '130008547543', '+1-540-603-2004', 'effertz.esther@example.org', 'male', '2003-02-17', 'Beatae omnis iure explicabo nihil nulla. Quam numquam recusandae totam quibusdam reiciendis placeat sit aut. Sed commodi dolor architecto.', 'unmarried', '1971-06-22 18:30:00', '2017-08-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(29, '961748', 9, 'Jessy Davis', 'Willard Batz', 'Maxwell Wiegand', '474516160725', '925.819.1293', 'iblanda@example.net', 'female', '1996-11-16', 'Sunt ea et et excepturi. Aut autem cupiditate quia. Eum rerum blanditiis qui saepe neque. Rem tempora est adipisci incidunt est assumenda.', 'unmarried', '1988-08-01 18:30:00', '2022-05-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(30, '708814', 1, 'Silas Shanahan', 'Nicolette Botsford', 'Jeremie Smith', '411624573113', '(864) 835-4842', 'korbin.mcdermott@example.com', 'male', '2001-10-08', 'Facilis reiciendis mollitia nisi qui sint. Eos omnis sed non quae quia perferendis et. Repellendus ex non architecto a saepe.', 'unmarried', '1971-01-25 18:30:00', '1985-01-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(31, '400424', 7, 'Vernie Nolan', 'Prof. Danielle O\'Keefe', 'Kiara Stiedemann', '465407955093', '+16145184106', 'rpredovic@example.org', 'female', '1978-10-26', 'Alias autem enim dignissimos mollitia harum. Nulla aut quaerat est blanditiis. Illo dolorem harum perspiciatis et fuga doloribus non.', 'married', '1990-12-01 18:30:00', '1989-08-07 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(32, '502870', 2, 'Prof. Ryder Berge', 'Meaghan Franecki', 'Mr. Kendall Botsford', '923780012216', '+1-304-355-4361', 'brooke14@example.net', 'female', '1986-03-03', 'Soluta est eligendi et praesentium. Et at beatae voluptatibus et et eaque. Deserunt quo quis officia ut odit. Velit dolores sapiente incidunt nihil animi explicabo omnis.', 'married', '2014-08-27 18:30:00', '1994-05-26 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(33, '191653', 10, 'Mrs. Georgette Kuvalis PhD', 'Prof. Berta Koch IV', 'Aiyana Welch', '340612978067', '+1.954.452.4102', 'anna.wehner@example.net', 'male', '1980-04-24', 'Reiciendis ducimus omnis rerum temporibus incidunt. Explicabo sed sunt illum velit non nostrum rerum. Animi ut ut eos omnis impedit.', 'married', '2008-03-19 18:30:00', '1988-03-06 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(34, '590878', 8, 'Mr. Mariano Wolff', 'Katrina Koepp', 'Elijah Streich', '761352459919', '820-209-1977', 'jaiden.adams@example.org', 'female', '1999-04-09', 'Et quia molestias similique commodi quidem ipsum nihil. Eos in in nemo omnis quod. Qui ipsum autem sit modi. Veniam quos maiores molestiae ut itaque culpa sunt.', 'unmarried', '2017-01-29 18:30:00', '1994-02-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(35, '417027', 6, 'Dr. Uriah Hauck Jr.', 'Dr. Hailee Okuneva', 'Noemi Mayert DDS', '665227761585', '+1-870-343-5608', 'hoeger.federico@example.org', 'male', '1976-05-27', 'Corporis voluptatem quis et quaerat facilis iste delectus. Aut reiciendis consectetur et totam blanditiis veritatis. Id rerum aperiam molestiae velit excepturi ut harum. Atque iure nobis qui laborum.', 'married', '2011-07-04 18:30:00', '1982-10-01 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(36, '909291', 3, 'Jalen Oberbrunner', 'Milo Koelpin', 'Samir Kovacek', '904831965689', '281.814.6652', 'maximo.ondricka@example.org', 'male', '1988-07-21', 'Tenetur libero eum mollitia voluptatem sed earum doloremque. Debitis quae nemo est voluptatibus.', 'married', '2019-12-08 18:30:00', '1984-03-06 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(37, '623889', 2, 'Zachary Champlin MD', 'Hermina Romaguera', 'Javonte Kshlerin', '139829896742', '(520) 419-6685', 'mary99@example.com', 'female', '1973-11-11', 'Et natus omnis enim consequatur quam quis. Excepturi dolorem velit maxime aut deserunt tempore. Atque quis autem et odio est. Omnis at recusandae aut fugit tenetur qui.', 'married', '2008-08-01 18:30:00', '1975-10-13 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(38, '226020', 6, 'Dariana Kemmer Sr.', 'Prof. Jacquelyn Wilderman I', 'Rosetta Buckridge MD', '758288343661', '+1-502-209-7784', 'jerrold00@example.net', 'male', '1975-08-06', 'Et quos iste molestiae excepturi id. Laboriosam ut quia consequuntur rerum dolorum sit et esse.', 'married', '2006-06-23 18:30:00', '1972-09-08 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(39, '622770', 2, 'Hillary Torp', 'Trudie Vandervort', 'Graciela Runolfsdottir Jr.', '538223300786', '+1.662.400.1939', 'fisher.josue@example.net', 'female', '1980-06-15', 'Dignissimos tempore sit temporibus. Dolorem dolores eius esse et quia deserunt quis odit.', 'unmarried', '2005-07-03 18:30:00', '2008-03-18 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(40, '952653', 1, 'Madison Steuber', 'Prof. Camryn Abernathy', 'Steve Bechtelar', '955811104315', '(947) 319-0219', 'lsteuber@example.com', 'male', '1986-08-05', 'Porro eveniet excepturi suscipit debitis beatae sed. Architecto maxime aut sint inventore. Ut est ut illo nemo quam ut. Magni enim dicta officiis voluptatum consequatur expedita.', 'unmarried', '2011-07-02 18:30:00', '1992-07-09 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(41, '372516', 8, 'Deborah Welch', 'Mrs. Elyse Gerlach Jr.', 'Gwen Mraz', '809626309058', '1-385-618-8254', 'dickens.anderson@example.net', 'female', '2005-06-24', 'Eum excepturi quia molestias deleniti veritatis est aut repellendus. Alias error ipsa iste est ducimus maxime. Cupiditate omnis expedita autem quisquam aut voluptatibus. Ea fuga et mollitia quibusdam aut.', 'married', '1995-09-10 18:30:00', '2022-06-10 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(42, '427567', 5, 'Dr. German Kiehn II', 'Eveline Reinger', 'Orrin Friesen V', '502973817835', '+1 (678) 528-3372', 'maryam33@example.org', 'male', '1977-09-08', 'Atque repellat iste voluptatem impedit. Tempore voluptas ut sit nemo necessitatibus fugiat et. Quia error illo voluptas. Quia id magnam occaecati occaecati aut quaerat nisi.', 'unmarried', '2005-04-01 18:30:00', '1987-11-24 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(43, '105776', 5, 'Grayce Yundt', 'Angelita Schulist Jr.', 'Oral Kutch', '992639648221', '1-534-375-5381', 'ebert.oral@example.com', 'female', '2004-10-31', 'Et excepturi mollitia et quos qui. Consequuntur ratione qui est voluptatem.', 'married', '1983-04-24 18:30:00', '1982-03-26 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(44, '184605', 10, 'Percival Zemlak', 'Triston Metz DDS', 'Leta Yundt', '590317806022', '626.261.1471', 'trinity.ullrich@example.net', 'male', '1974-07-30', 'Aut aperiam assumenda aut non quae velit. Eveniet cumque tempore totam eveniet minus sed perspiciatis. Et labore facere veniam sunt. Aut quam quo nisi velit minima et.', 'unmarried', '1992-05-06 18:30:00', '2003-12-05 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(45, '662995', 3, 'Dr. Chandler Grant', 'Albin Crooks III', 'Dorian Feil', '654993761267', '+1.636.958.3010', 'newell20@example.com', 'female', '1982-03-08', 'Ad aut qui mollitia tempore non. Non vero est natus occaecati. Rerum dolor commodi eos sed non sint quisquam.', 'unmarried', '1997-06-03 18:30:00', '2006-06-24 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(46, '109366', 1, 'Mabelle Keeling I', 'Dereck Streich', 'Leopold Zboncak', '338751699323', '(620) 372-8896', 'josefina87@example.org', 'female', '1970-10-19', 'Accusantium voluptatem facere consectetur ut asperiores quos. Sapiente ut doloribus molestiae expedita. Ut maiores ut qui. Non dicta impedit dolorem ducimus excepturi vel sequi.', 'unmarried', '1973-07-15 18:30:00', '2019-09-10 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(47, '241508', 2, 'Damian Tremblay', 'Belle Vandervort', 'Asa Rippin', '731485817993', '954.893.9119', 'hermann.brian@example.org', 'female', '1999-11-30', 'Aliquam quis aut est perspiciatis pariatur. Inventore rerum sed sapiente minima perferendis.', 'married', '1987-06-12 18:30:00', '2017-02-05 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(48, '823219', 3, 'Laverne Doyle', 'Madison Terry', 'Mallory Treutel', '277532909763', '+1-817-555-1100', 'imani.stark@example.org', 'male', '1997-12-13', 'Nostrum autem voluptas odit dolor nihil. Nesciunt aut maxime ipsa.', 'married', '1970-01-29 18:30:00', '1975-08-14 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(49, '430858', 2, 'Prof. Zula Kovacek DDS', 'King Schmidt', 'Ms. Ofelia Crona I', '145820645297', '+1.225.426.9069', 'eloise.mcdermott@example.org', 'male', '1970-11-22', 'Ab quis quo qui delectus architecto in. Dicta non alias soluta mollitia ut molestias qui.', 'unmarried', '1988-03-30 18:30:00', '1974-04-13 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(50, '659907', 5, 'Mrs. Herminia Maggio', 'Mrs. Ethelyn Sanford I', 'Danny Sipes', '652078298013', '(508) 595-5954', 'silas28@example.com', 'male', '1985-01-16', 'Et dignissimos quam omnis sit et. Modi cum nesciunt rerum odit sequi fugit. Fuga dolorum laboriosam eaque aliquam. Consequatur corrupti dolores a quis.', 'married', '1984-12-10 18:30:00', '2013-12-05 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(51, '638045', 5, 'Mr. Robin Rosenbaum', 'Steve Stanton', 'Miss Jennyfer Bruen Sr.', '244018012819', '434-737-8128', 'kara60@example.net', 'female', '1974-12-19', 'Magnam est perspiciatis nihil fugiat assumenda quidem. Fugiat tenetur quaerat sit et. Quia dolores porro vero magni. Ad eligendi sequi est impedit qui voluptatum dolorem.', 'unmarried', '2002-03-16 18:30:00', '1974-11-16 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(52, '309338', 10, 'Turner Kshlerin', 'Sydney Terry', 'Tierra Lowe', '489082276455', '308-503-6252', 'domingo.crooks@example.net', 'female', '1990-05-10', 'Iusto perferendis aut optio voluptate similique neque nulla. Sapiente et doloribus ducimus sapiente. Et ipsum culpa ex eos error optio.', 'unmarried', '2016-09-18 18:30:00', '1995-11-07 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(53, '835206', 7, 'Dean Wunsch', 'Carolina Rice', 'Prof. Jules Green DVM', '139196399190', '(701) 889-4893', 'caterina.rosenbaum@example.com', 'male', '1979-06-11', 'Quidem qui velit id quod non. Qui quisquam dicta ullam libero sapiente. Laudantium quia similique debitis maiores. Praesentium quia sint a non tenetur quo.', 'married', '1984-01-31 18:30:00', '2014-07-06 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(54, '796501', 5, 'Mrs. Keira Hauck', 'Hobart Koelpin', 'Ms. Noemi Keebler', '232727307440', '904.415.6563', 'nkoelpin@example.com', 'male', '2004-04-15', 'Cupiditate sunt excepturi voluptas mollitia. Esse hic vero minus sit ut nam. Accusamus reiciendis qui qui error beatae cumque est aut. Eos quos quae consequatur similique sunt.', 'unmarried', '1997-01-01 18:30:00', '1984-02-09 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(55, '486243', 4, 'Sharon Thompson', 'Anissa Fisher', 'Ms. Maritza Lehner DVM', '536596248522', '+1-812-341-6887', 'pweimann@example.net', 'male', '1990-01-26', 'Architecto ut vitae ab consequuntur distinctio illo ut. Maxime fugit quidem quia. Id dolore porro quia quae rerum.', 'married', '2018-10-29 18:30:00', '2008-03-12 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(56, '206117', 3, 'Loyce Grady', 'Cooper Altenwerth', 'Mabel Swift', '433343894161', '+1.559.468.4404', 'judah.legros@example.net', 'male', '1984-04-16', 'Corporis voluptatem architecto porro omnis omnis quo. Autem consequuntur odio aut ducimus quia. Neque et minus sed cupiditate voluptas. Dolorem odio vero expedita sint deleniti dolorem.', 'unmarried', '2021-03-14 18:30:00', '1975-11-20 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(57, '502890', 7, 'Kathlyn Boyer', 'Aryanna Quitzon', 'Prof. Brayan Nitzsche', '380246203384', '+1.314.634.1390', 'maritza21@example.com', 'male', '1987-05-30', 'Et praesentium qui consequatur. Non reiciendis reprehenderit dolorem fugiat et. Culpa maxime impedit vero odio adipisci.', 'married', '2010-02-09 18:30:00', '2016-12-23 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(58, '862533', 6, 'Kobe Littel', 'Dr. Arnold Mayer PhD', 'Hardy Fahey', '623733935099', '+1-678-960-1182', 'durgan.gideon@example.net', 'female', '2001-08-24', 'Sit rerum ab aut id. Sint nulla ab molestiae ipsa. Minima quaerat architecto at voluptatem sit nobis corporis. Odio in et eos aut.', 'unmarried', '2005-02-23 18:30:00', '1985-06-26 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(59, '774056', 5, 'Tyler Huels', 'Tremaine Runolfsson', 'Ms. Mittie Bergnaum Jr.', '632273135732', '785.529.3278', 'fjohns@example.com', 'female', '1992-07-18', 'Assumenda cumque quam quidem fugit. Omnis blanditiis sit qui suscipit. Laboriosam placeat exercitationem impedit suscipit itaque voluptas.', 'married', '1978-12-19 18:30:00', '2000-10-02 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(60, '776516', 8, 'Summer Boehm', 'Hugh Wisoky', 'Miss Vena Von MD', '549326051701', '361-312-0637', 'mayert.ari@example.org', 'male', '1981-02-10', 'Qui totam quia iure vitae voluptates voluptatum itaque. Quaerat rerum nulla adipisci similique sit veniam placeat voluptate. Totam error amet et et. Quibusdam id nemo ducimus est molestias fugit.', 'unmarried', '1989-02-14 18:30:00', '1981-06-03 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(61, '991937', 6, 'Prof. Tessie Nikolaus Jr.', 'Aryanna Torp', 'Nils Feeney DVM', '975950359149', '+1.209.968.8965', 'wpfeffer@example.com', 'female', '1999-11-17', 'Ut ullam totam sed eos. Impedit sit quos iure dolores dicta enim ut. Soluta fugiat sint omnis neque. Excepturi inventore doloribus culpa est repellendus hic aperiam eos.', 'married', '2003-12-14 18:30:00', '1984-06-02 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(62, '621813', 5, 'Mr. Mathias Yost', 'Gerald Hammes', 'Claudia Gerhold', '690704926598', '1-954-744-1202', 'kuhn.thelma@example.org', 'male', '2003-07-09', 'Nesciunt recusandae odio dolore excepturi et. Saepe repudiandae delectus et vel. Omnis molestias nam necessitatibus ex.', 'married', '2022-04-14 18:30:00', '2022-09-20 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(63, '712796', 8, 'Mrs. Lyla Langworth', 'Jarrod Stracke', 'Sabryna Gleason', '173328510355', '854.894.7685', 'karen.pollich@example.org', 'male', '1992-04-13', 'Doloremque necessitatibus enim numquam. Dolorem nisi quibusdam ipsam nulla sunt reiciendis. Impedit nobis autem reprehenderit qui.', 'married', '1992-05-22 18:30:00', '1975-12-30 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(64, '115477', 2, 'Miss Krista Lockman', 'Mr. Rogers Kunze', 'Ms. Dorothy Heller', '470969070464', '223.770.3348', 'beatrice.braun@example.net', 'male', '1990-03-09', 'Vel nemo et est quisquam. Placeat dolorem sit iusto amet quo.', 'married', '2010-06-14 18:30:00', '2023-04-15 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(65, '832276', 2, 'Darwin Welch', 'Joany Johnston', 'Glenda Murray', '653503292974', '651-305-8484', 'tfay@example.org', 'male', '2001-06-19', 'Numquam ut numquam impedit vel doloribus magni. Minima nulla aut maiores totam fugit tenetur repudiandae. Sed quae quasi nihil placeat facere quod. Quidem et ducimus ea est asperiores. Fugit rerum incidunt qui accusamus.', 'unmarried', '1979-08-24 18:30:00', '1970-02-22 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(66, '516171', 8, 'Romaine Altenwerth', 'Jordy Koss MD', 'Prof. Noemie Carroll III', '217526211819', '+18704091459', 'nolan.rath@example.com', 'male', '1985-10-28', 'Esse odit fugiat vero magnam eius omnis. Voluptate quibusdam delectus aliquam est ex et. Nobis qui nulla alias animi maiores aspernatur itaque. Repudiandae odio rerum consectetur ut quo sit.', 'married', '2014-05-19 18:30:00', '2018-10-12 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(67, '249980', 9, 'Florencio Hudson', 'Prof. Breanna Rodriguez', 'Greyson Rodriguez PhD', '403773165009', '+1-364-290-2124', 'emery66@example.org', 'male', '1972-11-17', 'Aut dolore delectus veniam numquam dolores cupiditate quos ea. Voluptas qui et dignissimos quibusdam. Doloremque aut non atque eum sit vel quidem iste. Quis dolorum praesentium ratione nemo debitis saepe.', 'unmarried', '2021-09-19 18:30:00', '1979-06-19 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(68, '991544', 7, 'Hope Boehm', 'Prof. Kayleigh Kuphal', 'Ms. Raphaelle Kris DVM', '569583295005', '(915) 407-0859', 'stracke.elton@example.net', 'female', '1982-05-10', 'Ducimus aliquam qui sit id. Sunt necessitatibus laudantium odit eligendi nulla commodi. Sint et iure harum at aliquam nam.', 'unmarried', '1979-01-20 18:30:00', '1991-08-26 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(69, '988583', 6, 'Phyllis Prosacco', 'Camren Tremblay', 'Mr. Deontae Funk', '588052346887', '(424) 396-6929', 'francisca37@example.com', 'male', '1983-01-23', 'Qui ut explicabo eligendi et. Omnis distinctio illo quia molestiae. Et maxime voluptatem quod nisi qui.', 'married', '2001-04-06 18:30:00', '2016-11-07 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(70, '150541', 1, 'Derrick Schultz', 'Ernesto Doyle', 'Dr. Jayne Green', '848211291848', '(912) 254-4061', 'kuhn.heber@example.org', 'male', '1977-02-09', 'Quo sunt sint placeat molestiae. Perspiciatis labore rerum dicta aperiam quod nam. Veniam repellat voluptatem blanditiis culpa. Quibusdam dignissimos et non dolorem asperiores quo.', 'married', '1987-02-05 18:30:00', '2023-01-31 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(71, '610109', 7, 'Victoria Stokes', 'Wayne Greenfelder', 'Rene Kautzer', '520543032367', '315.422.6664', 'annetta.boyer@example.com', 'female', '1995-12-17', 'Omnis aut rem rerum nobis distinctio consequatur. Odio sed consequuntur consequatur culpa consequatur quo. Ea facilis ut aspernatur. Alias voluptas eveniet eius non omnis pariatur.', 'married', '1979-11-10 18:30:00', '1990-10-12 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(72, '764101', 3, 'Lucy Klein', 'Jeffry Hamill', 'Dr. Corrine Heathcote', '985924668470', '352-629-3686', 'estevan.watsica@example.com', 'female', '2005-07-08', 'Vitae dolores sed dolores. Eius tenetur eveniet suscipit sit et tempore numquam. Officiis recusandae ut vel sequi omnis.', 'unmarried', '2009-05-22 18:30:00', '1995-11-03 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(73, '641248', 10, 'Arlo Lockman', 'Prof. Jean Schowalter Jr.', 'Lonny Purdy IV', '482575981448', '+15865281883', 'araceli17@example.net', 'female', '1984-05-14', 'Voluptatum tenetur porro hic illum consequatur atque sapiente. Labore optio corporis eligendi ullam non consequatur et. Qui deserunt officia quasi. Voluptatem esse quia assumenda quo consequatur. Nemo molestiae quae occaecati est quas et.', 'unmarried', '1981-05-17 18:30:00', '2007-09-03 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(74, '881448', 5, 'Brennan Huels', 'Ms. Lempi O\'Keefe', 'Dave Ortiz', '282399788697', '+1 (856) 204-6934', 'oconnell.hazle@example.net', 'female', '2004-06-01', 'Quia sit repellendus hic et a consequatur aut. Distinctio et sed quod animi inventore nulla id sint. Mollitia in tempora cumque et ipsum.', 'unmarried', '2022-06-18 18:30:00', '2009-08-05 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(75, '118579', 3, 'Arden Wilkinson II', 'Mr. Reggie Gaylord', 'Vella Considine', '270616485653', '+1-843-552-3880', 'lueilwitz.walter@example.org', 'female', '2004-12-25', 'Tempora consectetur fugit iusto ut non natus. Nostrum qui temporibus eos quam perspiciatis et. Nostrum nobis et et culpa consequatur est quaerat. Sequi incidunt qui tempora hic.', 'unmarried', '1973-08-11 18:30:00', '1984-08-02 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(76, '570954', 1, 'Prof. Garett Kutch MD', 'Lilian Cremin V', 'Abigail Nikolaus', '451427151876', '+16416732305', 'guido.sawayn@example.org', 'male', '1983-07-17', 'Ratione aspernatur velit ut a. Enim deleniti qui exercitationem. Nulla voluptates sint earum veritatis velit molestiae.', 'married', '2006-06-20 18:30:00', '2007-01-24 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(77, '552169', 3, 'Jaylan Wuckert', 'Efren McKenzie', 'Dr. Declan Larkin', '476231893417', '+1-803-720-5389', 'davis.georgette@example.com', 'female', '1971-01-05', 'Est non ratione in consectetur. Corrupti illo rerum distinctio cupiditate fuga sed. Natus quas id nobis aut.', 'married', '2018-01-02 18:30:00', '1979-07-12 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(78, '596328', 3, 'Shayna Rippin', 'Prof. Cali Botsford', 'Dr. Enid Dooley', '416189503088', '380.882.4284', 'eli44@example.com', 'male', '1995-04-23', 'Porro non voluptas optio non ipsam dolor. Repellat suscipit nihil qui sed cumque corrupti possimus. Voluptatum earum dolores dolores culpa. Quasi modi ut illum aut.', 'married', '2015-11-01 18:30:00', '2002-07-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(79, '861903', 10, 'Reese Doyle', 'Miss Beulah Gottlieb', 'Mr. Jerrold Renner II', '981617808433', '818.673.3612', 'reichel.axel@example.com', 'female', '1984-01-11', 'Odit aperiam hic quasi sit magnam maiores voluptas omnis. Ab eum velit voluptatem. Quo doloribus atque voluptates et quibusdam optio quis consequatur. Sapiente consequatur minima incidunt amet excepturi eligendi.', 'married', '1986-02-03 18:30:00', '1985-08-02 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(80, '889240', 3, 'Daniela Mayer', 'Lesley Schroeder', 'Mauricio Moore Jr.', '136234746568', '+1 (347) 756-4141', 'bschuster@example.net', 'male', '1978-10-26', 'Quod vitae sit perferendis saepe voluptatibus. Iure soluta unde nesciunt non est nemo quod. Doloribus quaerat ipsa quas praesentium asperiores odit officia. Exercitationem quo et amet facere blanditiis totam ipsa.', 'unmarried', '2013-01-07 18:30:00', '2013-07-11 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(81, '734964', 4, 'Valentine Legros MD', 'Lindsay Rolfson', 'Ova Rohan', '108435498724', '(323) 317-2960', 'kuvalis.rebeka@example.org', 'female', '1973-03-30', 'Aut et a numquam sunt illo quam. Ducimus ut est impedit ut corrupti. Et nihil ut atque quibusdam placeat et blanditiis.', 'married', '1977-04-14 18:30:00', '2024-04-16 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(82, '481155', 3, 'Mandy Cole', 'Amely Lemke I', 'Mia Bosco', '401264547394', '803.841.8519', 'ivon@example.com', 'female', '1974-10-30', 'Aut maxime odio quos ea. Nihil aut quisquam eius aut ab voluptatem totam. Delectus et sapiente maiores consequatur quisquam id doloremque recusandae.', 'unmarried', '1992-12-25 18:30:00', '2016-09-28 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(83, '505774', 2, 'Oran Predovic', 'Hillary Tillman', 'Lambert Weber', '394704789615', '+1 (408) 436-6375', 'ebba01@example.net', 'female', '1984-11-03', 'Exercitationem ratione minus ea itaque beatae. Numquam autem ex in et eos voluptas.', 'unmarried', '1989-03-24 18:30:00', '2007-01-30 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(84, '808212', 5, 'Miss Cathy Ziemann', 'Lorena Wisozk DDS', 'Velda Hettinger IV', '144922160224', '+1-870-491-9750', 'aubrey.dooley@example.com', 'male', '1988-01-04', 'Suscipit et dolor eligendi fugiat omnis. Corporis eius quaerat fugit qui sapiente. Dolorem non ea neque veniam.', 'unmarried', '2013-05-01 18:30:00', '2023-02-09 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(85, '989985', 10, 'Maximilian Greenholt I', 'Derick Farrell V', 'May Jakubowski', '358571894068', '352-724-4612', 'arturo.schulist@example.net', 'male', '1972-03-13', 'Id est delectus fugiat et. Quod voluptatem consequatur aliquid omnis porro. Sit veritatis ipsa molestiae ut. Rerum eos occaecati quod ut iure.', 'married', '1989-02-06 18:30:00', '2003-12-11 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(86, '708787', 8, 'Prof. Ronaldo Kovacek', 'Enoch McGlynn', 'Jessika Bahringer', '131628827443', '1-657-218-9908', 'beahan.lora@example.com', 'male', '1983-02-13', 'Necessitatibus et earum ut vitae omnis deserunt. Laboriosam repellendus porro dolorem. Labore dolores porro voluptate eveniet quo. Nulla sunt porro explicabo officiis animi molestias.', 'unmarried', '1983-11-25 18:30:00', '1995-04-19 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(87, '632034', 6, 'Dr. Brigitte Hamill', 'Pink Bergstrom', 'Nora Ward', '963545833266', '+17073867631', 'toby.crist@example.net', 'male', '1991-01-23', 'Eligendi expedita fugit aspernatur voluptas quos laborum. Rem voluptatibus minima natus. Aliquid sunt quo expedita ullam nam laudantium ea error. Laborum repudiandae illum deleniti omnis.', 'unmarried', '1973-04-12 18:30:00', '1987-04-10 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(88, '501714', 6, 'Nichole Cummings', 'Courtney Zulauf', 'Henri Thompson', '442668550029', '346.846.0564', 'eveline68@example.com', 'female', '1984-08-07', 'Atque dolorem ipsam aspernatur distinctio. Vero porro in iste sunt corporis iusto sunt eum. Iusto eum quibusdam rerum expedita consectetur aut explicabo.', 'unmarried', '1981-06-09 18:30:00', '1976-06-18 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(89, '507073', 9, 'Mr. Kane Zemlak', 'Tyra Hamill', 'Xavier Adams', '969315686161', '+1-361-765-4782', 'freda.boehm@example.com', 'male', '2004-07-11', 'Aspernatur qui consequuntur tempora saepe. Voluptas vero rerum at expedita. Est neque voluptatem optio nihil est unde. Voluptas aperiam sint repellendus architecto.', 'married', '1995-09-08 18:30:00', '1982-03-05 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(90, '706078', 4, 'Mr. Arturo Moore Jr.', 'Barry Dickinson MD', 'Bartholome Herman', '649648129968', '(725) 362-8418', 'foberbrunner@example.com', 'female', '1985-11-13', 'Molestiae qui vero facilis harum. Fuga laborum aperiam quidem veritatis voluptatibus dolor rerum. Cupiditate in quam et distinctio totam.', 'married', '1971-09-11 18:30:00', '1979-07-31 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(91, '854826', 7, 'Dr. Danial Kuvalis', 'Caden Kertzmann', 'Mrs. Eliane Reichel DVM', '696279123327', '239.726.0366', 'korey.stark@example.org', 'male', '1992-02-09', 'Et eum ut non qui. Recusandae voluptate eveniet voluptatem sed quibusdam. Vero praesentium ex quisquam quos impedit. Quisquam totam officiis cupiditate temporibus ducimus.', 'married', '1992-09-16 18:30:00', '2018-11-06 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(92, '120817', 6, 'Prof. Mable Wuckert', 'Dillon Leffler', 'Jayme Kuhn', '981411991323', '1-920-365-0059', 'jadyn.green@example.com', 'male', '1985-12-14', 'Et eum ut omnis eligendi. Sunt consequatur quaerat quis optio. Sit aut in porro labore. Tempore quia libero blanditiis aut optio nemo.', 'unmarried', '1978-08-11 18:30:00', '1972-02-22 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(93, '875669', 8, 'Rebeka Wyman', 'Prof. Wilburn Dicki', 'Cristopher Abernathy', '148083620528', '(219) 598-6575', 'elaina.schulist@example.org', 'female', '1981-10-22', 'Aspernatur reprehenderit veritatis ut id et. Aliquid cupiditate nemo enim. Et dolore adipisci blanditiis officiis quisquam numquam. Ducimus velit veritatis ipsa blanditiis dicta ut eos excepturi. Id at ut sit architecto.', 'married', '1973-12-09 18:30:00', '1982-11-16 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(94, '670737', 1, 'Kamille Berge', 'Jeff Jacobs III', 'Elian Bednar', '271055572278', '+1.520.853.1500', 'mandy.reynolds@example.org', 'female', '1973-04-09', 'Vel excepturi doloremque saepe ipsam quis doloremque rem. Nisi aut magnam aperiam aliquid. Sint corrupti aliquam id eveniet accusantium magni molestias. Et est corporis cumque et.', 'married', '2019-03-08 18:30:00', '1979-09-04 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(95, '953625', 2, 'Prof. Garth Olson V', 'Kenneth Pfannerstill MD', 'Prof. Ulises Carter', '383511261755', '(417) 267-9985', 'buckridge.francesco@example.org', 'female', '1995-05-01', 'Iure rem et qui sed sit ad ad. Dolorum officiis esse molestiae soluta quisquam voluptates. Tenetur illum necessitatibus vel tempora voluptatem vel.', 'married', '2006-06-26 18:30:00', '1978-11-12 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(96, '825746', 10, 'Dr. Tate Lebsack II', 'Juwan Christiansen', 'Mrs. Annalise Breitenberg', '462705367585', '(617) 363-3102', 'corwin.pinkie@example.com', 'male', '1999-07-16', 'Nisi qui natus aut. Culpa blanditiis sit et ipsam. Reprehenderit iusto aliquid id. Eligendi est veritatis aut est qui.', 'married', '1978-10-13 18:30:00', '1970-05-20 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(97, '837097', 9, 'Mr. Levi Becker V', 'Lelah McLaughlin III', 'Dr. Flavie Bergnaum I', '223614237050', '+1-640-379-3808', 'justina91@example.com', 'female', '1970-09-05', 'Praesentium at eos quia eum. Dolores porro voluptatem adipisci consequuntur qui ipsam. Ab cum quos est omnis. Est ut dolorem eos. Veritatis ducimus dolor rerum doloribus.', 'married', '1997-11-16 18:30:00', '1993-12-11 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(98, '617873', 10, 'Manuel Becker', 'Maybell Aufderhar DVM', 'Ms. Sydnee Stanton', '719266597975', '+12235480062', 'edward47@example.com', 'female', '1994-06-28', 'Id expedita eveniet fugiat. Sapiente commodi corporis illum illo ut. Ipsum numquam consequatur aut accusantium. Et aut quo esse aut.', 'married', '1973-10-01 18:30:00', '1979-04-03 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(99, '917036', 9, 'Jarret Hirthe', 'Allie Wiza', 'Rosina McKenzie', '201728203246', '1-717-935-3353', 'dlabadie@example.com', 'male', '2002-03-29', 'Unde voluptatem qui doloremque incidunt esse. Voluptate consectetur consequuntur qui eum. Non repudiandae maiores eveniet deleniti illum id. Magnam recusandae et et.', 'married', '2014-06-06 18:30:00', '1999-03-16 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL),
(100, '868546', 4, 'Elisabeth Terry', 'Ms. Kaelyn Mertz DDS', 'Thad Volkman', '847996927481', '1-786-532-1457', 'twolf@example.net', 'female', '1979-06-14', 'Ut beatae beatae voluptas aperiam voluptatibus error dolores. Eaque amet nemo dolor similique. Officiis unde rem debitis cum sunt ducimus et.', 'unmarried', '1973-10-24 18:30:00', '1994-05-20 18:30:00', '2025-01-10 07:38:03', '2025-01-10 07:38:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','leave') DEFAULT 'present',
  `leave_reason` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `fees` double DEFAULT '35000',
  `remarks` text,
  `payment_instrument` enum('online','cash') DEFAULT 'cash',
  `payment_through` enum('RTGS','NEFT','IMPS','UPI','CASH') DEFAULT 'CASH',
  `payment_ref_no` varchar(255) DEFAULT NULL,
  `due_date` date NOT NULL,
  `received_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `course_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `id` int NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dwight Lynch', 'block.graciela@example.org', NULL, '$2y$12$hni0bhExy1PqUXJ0bIK/t.j7eg72Yk7tHCSAmcsI1lLFXbu31nYcq', NULL, '2025-01-07 14:05:45', '2025-01-07 14:05:45'),
(2, 'Prof. Sonya Bogisich', 'jruecker@example.com', NULL, '$2y$12$ZjwF5pvGOuyDvpch/eCzkOjAqaIaKgndzwaISiN9c5mpohypQRUwK', NULL, '2025-01-07 14:05:46', '2025-01-07 14:05:46'),
(3, 'Isaiah Yundt', 'cbrakus@example.com', NULL, '$2y$12$M/TLXrcGEczzf3Y8VDpgKOScbCtcuV/.esEBoqq/OoE5zXILjrWW.', NULL, '2025-01-07 14:05:46', '2025-01-07 14:05:46'),
(4, 'Willy Waelchi', 'mireille.jones@example.com', NULL, '$2y$12$92aCplSMC2zeY2x4yMnmmeZb4BTCNr2Cpd8yXjYCxMHRKi8hT6edW', NULL, '2025-01-07 14:05:46', '2025-01-07 14:05:46'),
(5, 'Kolby Strosin IV', 'clarabelle.cummerata@example.com', NULL, '$2y$12$7bZZgZPc3YrInPcYLcL58.i5U5D0UQtCdqcwSK3gAMbA4wNoeydPq', NULL, '2025-01-07 14:05:46', '2025-01-07 14:05:46'),
(6, 'Albertha Harber', 'gleason.maymie@example.com', NULL, '$2y$12$VVxNVf9MADm19isSFeZu1OSw3wbJikp.HIBYZicXO42.kseigzBt6', NULL, '2025-01-07 14:05:47', '2025-01-07 14:05:47'),
(7, 'Cortez Crist DDS', 'damore.shaina@example.net', NULL, '$2y$12$50IIom.7Im9lan5mCULSru.R/9WE1aocVa2umxf5Bwlhi4jSkhouK', NULL, '2025-01-07 14:05:47', '2025-01-07 14:05:47'),
(8, 'Kayley Kirlin', 'molly.daniel@example.net', NULL, '$2y$12$Hdt0En9SibWjopJ22vfyeOkf8uPWjBwq50l8mO496Loq0nrKc1Nci', NULL, '2025-01-07 14:05:47', '2025-01-07 14:05:47'),
(9, 'Esther Boehm', 'reichert.marcelle@example.com', NULL, '$2y$12$ICTbarLrp/aPUmFCMancS.Gvv5j8IeAHsMhhXzTA7mtK/gq0U5JwW', NULL, '2025-01-07 14:05:48', '2025-01-07 14:05:48'),
(10, 'Irma Ratke', 'ernie20@example.net', NULL, '$2y$12$O2fVappvOiLNETTVY4hLJ.EkeFbJssbf6Z7fXUpzUR9XEgz8LCn8O', NULL, '2025-01-07 14:05:48', '2025-01-07 14:05:48'),
(11, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$2MbXKQvkW.GiwCtYzxxcgu8Zu49iE9LTeWhDys7yDBoYJUOkynheG', NULL, '2025-01-07 14:05:48', '2025-01-07 14:05:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_assets`
--
ALTER TABLE `event_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_papers`
--
ALTER TABLE `exam_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_attendance`
--
ALTER TABLE `faculty_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_books`
--
ALTER TABLE `library_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management_team`
--
ALTER TABLE `management_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_assets`
--
ALTER TABLE `event_assets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_papers`
--
ALTER TABLE `exam_papers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_attendance`
--
ALTER TABLE `faculty_attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_books`
--
ALTER TABLE `library_books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management_team`
--
ALTER TABLE `management_team`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
