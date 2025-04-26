# DB Connection Checker

This is a simple PHP application to test the connectivity to a MySQL or PostgreSQL database. The user can provide database connection details through a form and check if the connection is successful or if there is any error.

## Features

- **Database Type Selection**: Choose between MySQL and PostgreSQL.
- **Connection Test**: Test the database connection based on the provided host, database name, username, and password.
- **Error Handling**: Displays specific error messages based on common database connection errors.
- **Session Management**: Once the connection is successful, the session is updated to reflect the connection status.

## Requirements

- PHP 7.0 or higher
- MySQL or PostgreSQL database

## Installation

1. Clone or download the repository to your local machine.
2. Place the project files in your web server's directory (e.g., `htdocs` for XAMPP).
3. Create a new database in either MySQL or PostgreSQL to test the connection.
4. Start the local server and open `index.php` in your browser.

## Usage

1. When you open the application, you will see a form to enter your database connection details.
2. Select the database type (MySQL or PostgreSQL), then provide the required details such as:
   - Host (e.g., `localhost`)
   - Database Name
   - Username
   - Password (optional)
3. Click on **Test Connection** to check the database connectivity.
4. If the connection is successful, a success message will appear along with a button to disconnect.
5. If the connection fails, an error message will display the reason for the failure (e.g., incorrect username, database not found, etc.).

## Example

### Successful Connection:

<img width="1470" alt="Ekran Resmi 2025-04-27 00 42 29" src="https://github.com/user-attachments/assets/68f4301f-2578-46ee-bd76-1dc7da3f8286" />


### Failed Connection:

<img width="1470" alt="Ekran Resmi 2025-04-27 00 40 57" src="https://github.com/user-attachments/assets/655ca7cb-20a5-47e3-ac79-6ed1728964e1" />


## Code Overview

- **Form Submission**: The form is submitted via POST method to test the connection.
- **Database Connection**: Uses PDO (PHP Data Objects) for database interaction.
- **Error Handling**: Various database errors are handled by specific error codes and customized messages.
- **Session Management**: The connection status is stored in the session for the current session and can be checked by the user.

## License

This project is open-source and available under the MIT License.

## Contributing

Feel free to fork this project and submit pull requests. If you find bugs or have suggestions for improvements, feel free to open an issue.

## Acknowledgements

- Bootstrap for styling the UI components.
- PDO for database connections.
- Bootstrap Icons for the visual representation of success and failure.
