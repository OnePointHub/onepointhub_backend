# Helpdesk & Customer Support Module

## Helpdesk & Customer Support
1. Knowledge Base
   * Articles and FAQs: - DONE
     * Provide a repository of articles, FAQs, and guides to help customers find solutions to common problems independently.
   * Search Functionality: - IN PROGRESS
     * Implement a robust search feature to help users quickly find relevant information.
   * Categories: - DONE
     * Organize articles into categories for easy navigation.

2. Ticket Management System
    * Ticket Creation:
        * Allow customers to create tickets via email, web forms, or chat. Provide options for customers to attach files or provide detailed descriptions.
    * Ticket Tracking:
        * Enable tracking of ticket status (e.g. Open, In Progress, Resolved, Closed) and display ticket history for each customer.
    * Categorizations:
        * Automatically or manually categorize tickets (e.g. Billings, Technical Issue, General Inquiry) to streamline routing and resolution.
    * Prioritization:
        * Set priorities (e.g. Low, Medium, High) to manage urgent issues effectively.
3. Multi-Channel Support
    * Email Integration:
        * Manage customer queries and tickets through email integration.
    * Live Chat:
        * Offer real-time support via chat. Include features like chat transcripts and proactive chat invitations.
    * Phone Support:
        * Provide options for customers to request callbacks or connect with support agents directly via phone.
    * Social Media Integration:
        * Monitor and respond to customer queries on social media platforms.
4. Automated Responses and Workflows
    * Auto-Responses:
        * Send automated replies to acknowledge receipt of tickets and provide initial information.
    * Workflow Automation:
        * Automate common tasks such as ticket routing, escalations, and status updates based on predefined rules.
5. Agent Management
    * Agent Profiles:
        * Create profiles for support agents with information such as skills, roles, and contact details.
    * Role-Based Access:
        * Define permissions and access levels based on agent roles (e.g., Support Agent, Supervisor).
    * Performance Metrics:
        * Track and analyze agent performance metrics such as ticket resolution times and customer satisfaction scores.
6. CRM Integration
    * Customer Profiles:
        * Link tickets and interactions to customer profiles for a complete view of their history and preferences.
    * Interaction History:
        * Maintain a log of all customer interactions and support tickets.
7. Reporting and Analytics
    * Ticket Analytics:
        * Generate reports on ticket volume, resolution times, and response times.
    * Customer Feedback:
        * Collect and analyze customer feedback on support interactions to identify areas for improvement.
    * Agent Performance:
        * Track individual agent performance metrics to ensure high-quality support.
8. Self-Service Options
    * Customer Portal:
        * Provide a self-service portal where customers can view their tickets, check status, and update information.
    * Community Forums:
        * Enable customers to participate in forums or discussion boards where they can ask questions and share solutions.
9. Customization and Branding
    * Customizable Templates:
        * Allow customization of email templates, ticket forms, and chat widgets to match the company’s branding.
    * Branding:
        * Ensure the support interface aligns with the overall branding and design of the application.
10. Security and Compliance
    * Data Security:
        * Implement security measures to protect sensitive customer data and comply with data protection regulations.
    * Access Control:
        * Manage access to sensitive information and features based on user roles and permissions.
11. Integration with Other Modules
    * CRM Integration:
        * Sync support data with the CRM module for a unified view of customer interactions.
    * Analytics Integration:
        * Combine support data with business analytics to track overall performance and customer satisfaction.
12. Training & Support for Agents
    * Training Materials:
        * Provide resources and training materials to help agents effectively use the helpdesk system and handle various types of inquiries.
    * Support Resources:
        * Offer internal support for agents, such as help documentation and escalation procedures. 

# Helpdesk & Customer Support ToDo:
* Search KB Article


# Helpdesk & Customer Support Done:
* KB Articles:
    * Create KB Article
    * Update KB Article
    * Delete KB Article
    * Get all KB Articles
    * Get single KB Article
    * Publish KB Article
    * Unpublish KB Article
* Categories:
    * Create Category
    * Update Category
    * Delete Category
    * Get all Categories
    * Get single Category
* FAQs:
    * Create FAQ
    * Update FAQ
    * Delete FAQ
    * Get all FAQs
    * Get single FAQ
    * Publish FAQ
    * Unpublish FAQ

# Routes

### All routes have a prefix of '/api/v1/'

## Helpdesk & Customer Support Module: Route prefix '/helpdesk'

### Knowledge Base Articles

| Method | URL                               | Description                       | Example                                                                  |
|--------|-----------------------------------|-----------------------------------|--------------------------------------------------------------------------|
| GET    | /kb/                              | Get all KB Articles               | https://example.com/api/v1/helpdesk/kb                                   |
| GET    | /kb/{slug}                        | Get a specific KB Article         | https://example.com/api/v1/helpdesk/kb/article-1                         |
| POST   | /kb/                              | Create a new KB Article           | https://example.com/api/v1/helpdesk/kb                                   |
| PUT    | /kb/{slug}                        | Update KB Article                 | https://example.com/api/v1/helpdesk/kb/article-1                         |
| DELETE | /kb/{slug}                        | Delete KB Article                 | https://example.com/api/v1/helpdesk/kb/article-1                         |
| PUT    | /kb/{slug}/publish/{publishDate?} | Publish a KB Article              | https://example.com/api/v1/helpdesk/kb/article-1/publish/{optional-Date} |
| PUT    | /kb/{slug}/unpublish              | Unpublish a KB Article            | https://example.com/api/v1/helpdesk/kb/article-1/unpublish               |

### Knowledge Base Categories

| Method | URL                                     | Description                       | Example                                                                    |
|--------|-----------------------------------------|-----------------------------------|----------------------------------------------------------------------------|
| GET    | /categories/                            | Get all Categories                | https://example.com/api/v1/helpdesk/categories                             |
| GET    | /categories/{slug}                      | Get a specific Category           | https://example.com/api/v1/helpdesk/categories/category-1                  |
| POST   | /categories/                            | Create a new Category             | https://example.com/api/v1/helpdesk/categories                             |
| PUT    | /categories/{slug}                      | Update Category                   | https://example.com/api/v1/helpdesk/categories/category-1                  |
| DELETE | /categories/{slug}                      | Delete Category                   | https://example.com/api/v1/helpdesk/categories/category-1                  |

### FAQs

| Method | URL                               | Description        | Example                                                           |
|--------|-----------------------------------|--------------------|-------------------------------------------------------------------|
| GET    | /faq/                             | Get all FAQs       | https://example.com/api/v1/helpdesk/faq                           |
| GET    | /faq/{faq}                        | Get a specific FAQ | https://example.com/api/v1/helpdesk/faq/1                         |
| POST   | /faq/                             | Create a new FAQ   | https://example.com/api/v1/helpdesk/faq                           |
| PUT    | /faq/{faq}                        | Update FAQ         | https://example.com/api/v1/helpdesk/faq/1                         |
| DELETE | /faq/{faq}                        | Delete FAQ         | https://example.com/api/v1/helpdesk/faq/1                         |
| PUT    | /faq/{faq}/publish/{publishDate?} | Publish a FAQ      | https://example.com/api/v1/helpdesk/faq/1/publish/{optional-Date} |
| PUT    | /faq/{faq}/unpublish              | Unpublish a FAQ    | https://example.com/api/v1/helpdesk/faq/1/unpublish               |


# Helpdesk & Customer Support Database Scheme:

## KB Articles:
### Table Name: kb_articles

| Field        | Type            | Null | Key | Default | Extra          |
|--------------|-----------------|------|-----|---------|----------------|
| id           | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| category_id  | bigint unsigned | NO   | MUL | NULL    |                |
| title        | varchar(255)    | NO   |     | NULL    |                |
| slug         | varchar(255)    | NO   |     | NULL    |                |
| body         | text            | NO   |     | NULL    |                |
| published_at | datetime        | YES  |     | NULL    |                |
| created_at   | timestamp       | YES  |     | NULL    |                |
| updated_at   | timestamp       | YES  |     | NULL    |                |

## Categories:
### Table Name: kb_categories

| Field      | Type            | Null | Key | Default | Extra          |
|------------|-----------------|------|-----|---------|----------------|
| id         | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(255)    | NO   |     | NULL    |                |
| slug       | varchar(255)    | NO   |     | NULL    |                |
| created_at | timestamp       | YES  |     | NULL    |                |
| updated_at | timestamp       | YES  |     | NULL    |                |

## FAQs:
### Table Name: faqs

| Field        | Type            | Null | Key | Default | Extra          |
|--------------|-----------------|------|-----|---------|----------------|
| id           | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| question     | varchar(255)    | NO   |     | NULL    |                |
| answer       | text            | NO   |     | NULL    |                |
| published_at | datetime        | YES  |     | NULL    |                |
| created_at   | timestamp       | YES  |     | NULL    |                |
| updated_at   | timestamp       | YES  |     | NULL    |                |

# Helpdesk & Customer Support Roles & Permissions:

## Permissions:
* FAQs:
    * Can Read FAQ
    * Can Edit FAQ
    * Can Create FAQ
    * Can Delete FAQ
    * Can Publish FAQ
    * Can Unpublish FAQ
* Categories:
    * Can Read Category
    * Can Edit Category
    * Can Create Category
    * Can Delete Category
* KB Articles
    * Can Read KB Article
    * Can Edit KB Article
    * Can Create KB Article
    * Can Delete KB Article
    * Can Publish KB Article
    * Can Unpublish KB Article

## Roles:
* Customer:
    * Can Read FAQ
    * Can Read Categories
    * Can Read KB Articles
* Agent:
    * All Customer Permissions
    * Can Create FAQ
    * Can Edit FAQ
    * Can Create KB Article
    * Can Edit KB Article
* Helpdesk Admin:
    * All Customer Permissions
    * All Agent Permissions
    * Can Publish FAQ
    * Can Unpublish FAQ
    * Can Create Category
    * Can Edit Category
    * Can Publish KB Article
    * Can Unpublish KB Article
    * Can Assign Roles to Users
