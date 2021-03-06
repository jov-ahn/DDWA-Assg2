# DDWA Assignment 2 Hintel App
 
## Design Process

The purpose of this database allow owners of Boutique Hotels to access information from past to present and stay organised as well. The database includes information such as Dashboard, Rooms, Users, Bills, Inventory Management, Expenses Management and Team. All these pages allows them to work better. For example, if the owners wish to check which items needs to be re-stock they can go to the Inventory Management which shows information such as the item's name and amount of stocks currently. 
### User Stories
- As a higher up of a Boutique Hotel, I want to have an app that is clean, professional and easy to view to have a focused work flow
- As a higher up of a Boutique Hotel, I want to have an app with a modern, bright and professional colour scheme to not only motivate myself with the work in mind but also provide more life to the product.

## Features
- Ability to perform Create, Read, Update, Delete ( CRUD ) on 
    - Staff Details
    - Bills
    - Member Details
    - Inventory 
       - Count
       - Details
    - Room Details
 
### Existing Features
- Ability to perform Create, Read, Update, Delete ( CRUD ) on 
    - Staff Details
    - Bills
    - Member Details
    - Inventory 
       - Count
       - Details
    - Room Details

### Features Left to Implement
- Displaying data in charts
- Syncing up extra items in rooms with inventory

## Technologies Used
- [HTML](https://html.com/)
    - The project uses **HTML** to create the app's structure.
- [PHP](https://www.php.net/)
    - The project uses **PHP** to create & link server side related data stored on a server.
- [XAMPP](https://www.apachefriends.org/)
    - The project uses **XAMPP** to connect, create & edit databases that contain data for different needs ( Log In details, Staff Details, etc. ).
- [CSS](https://developer.mozilla.org/en-US/docs/Web/CSS)
    - The project uses **CSS** to design, describe & present our unique and attractive app design.
- [JavaScript](https://www.javascript.com/)
    - The project uses **JavaScript** to define behaviours of buttons, linking data from databases & API.
- [JQuery](https://jquery.com)
    - The project uses **JQuery** to simplify DOM manipulation.


## Testing

### Login Details
Admin  
Username: admin  
Password: admin  

Staff  
Username: staff  
Password: staff  

User  
Username: user  
Password: user  

1. Any data entry form:
    1. Go to any data entry form such as staff
    2. Try to submit the empty form and verify that an error message about the required fields appears
    3. Try to submit the form with an invalid data ( such as entering letters instead of numbers in ID ) and verify that an error message about the incorrect data field appears
    4. Try to submit the form with all inputs valid and verify that a success message appears.

2. Login page:
   1. Try to submit the empty form and verify that an error message about the required fields appears
   2. Try to submit the form with username blank and verify that an error message about the missing password field appears
   3. Try to submit the form with password blank and verify that an error message about the missing username field appears
   4. Try to submit the form with wrong login information and verify that an error message appears
   5. Try to submit the form with correct login information and verify that the user gets redirected to the index page

3. Logging out:
   1. Check when the user clicks on the log out button they will get an  alert informing them that they have been logged out 
   2. Check when the user clicks on OK they get redirected to the login page
   
## Screen Size

This app was designed using **Web 1920** as a reference point
   - Build for Web Browsers ( Google Chrome, FireFox, Microsoft Edge )
      - Does not include Internet Explorer
   - **Landscape** 
   - 1920 pixels by 1080 pixels
   - Responsive sizing
       - Able to resize for tablet and phone browsers

## Bugs
   - 
## Import Instructions

Before doing this, make sure you have downloaded XAMPP Control Panel.

1. Open up XAMPP Control Panel and press "Start" on Apache and MySQL
2. Create a new database by clicking "New" on the left side of the panel
3. Next, click on "Import" located in the top menu bar
4. Click on "Choose file" and import the "hintel.sql"
5. Lastly, click on "Go" on the bottom right corner of the page and you are all set!

## Credits
- Bing Heng
- Jovan
- Joo Siang
- Jia Jun
- Sean
- Zen

### Content
- The Bootstrap template was taken from [StartBootStrap](https://startbootstrap.com/previews/sb-admin-2)

### Acknowledgements
- I received inspiration for this project from Pinterest under [DME Hotel App](https://pin.it/6wsIEbe) Board
