# EmployeeLeave

The employee leave management system, the system is gonna be used to automate the workflow of a company's leave application and the approvals of the admins.
There is going to be a page for each functions:

* employee login
* leave form
* leave history
* admin dashboard
* register new employee

Admin Features:

- can approve and disaprove a leave application
- See the list of employee that is applying for leave

Employee features:
- login with an username and password
- apply for leave
- view the leave history

language used: php, html
database: mysql

The homepage.php serves as the starting point of the application. After logging in, the system checks if the logged-in individual is an admin or a user. If an admin, they are redirected to admin.php. if a user, they proceed to apply-leave.php. New registrations are automatically set as a user by default. Changing an account to admin status requires a manual SQL query.

User Workflow (Case 1: Accessing apply-leave.php)
1. Applying for Leave: Users can submit a leave application through the apply-leave.php page. Here, they need to fill in details such as the start and end date of their leave and the reason for the leave.
2. View Current Applications: Users can view their current leave applications on the same page. By default, the status of any new application is set to 'pending'.
3. Checking Application Status: Once an application is approved or rejected by an admin, users can view the updated status on the apply-leave.php page.
Admin Workflow (Case 2: Accessing admin.php)
1. View Leave Applications: Admins can view a list of all leave applications on the admin.php page. This list includes details such as from date, to date, username, and the reason for the leave.
2. Approve or Reject Applications: Beside each entry in the list, admins have the option to approve or reject the leave request. Once an action is taken, the application is automatically removed from the list.
Additional Features
* Registration: From the homepage.php, users can navigate to register.php to create a new account.
* Password Reset: If users forget their password, they can select the "forgot password" option, which redirects them to a page where they can enter their username and set a new password. This updates the password in the database.
* Login: After registration or resetting a password, users can log in to their account where they can access features based on their role (user or admin).

