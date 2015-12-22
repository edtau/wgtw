# wgtw 1.1
Application to build question and answer system. With this application you have somewhat of a stackoverflow clone and works about 
the same as that page. 
You can vote on posts, comments, answers and questions. Ask questions. Answer to the questions. 

Built on ANAX-MVC
# Installation
To install the application you first need to download a copy. Please feel free to either clone or download the package as a zip-file. 
Put all the files in the root folder and do the following. 

1. Modify the .htaccess to get clean urls according to your server standards, the file is located in the folder webroot. 
2. Open the file config_with_app.php and enter your database details. The file is located in the folder app/config/database. 
3. If everything is done correctly go to the url (name of your application)webroot/install. 
4. The application sets up the database tables and you are redo to work with the application. 
5. It is highly recommended to uncomment the installController after installation, the file is located in app/src/install. 
## Home 
This link is the startpage for the application, information about the posted questions, users and tags is displayed here. 

## Questions 
This link show a list of all the posted qustions. If you click on the name you get redirected to the page with the question and the 
answers/comments that belong to it. 


##  Users
Display a list with the users and their rank. If you click on a user a the user profile is displays. 

## Tags
Tags is used to display the tags and to add more tags to the database you have to be logged in to do this. 

## Ask Question
If logged in this is where you ask the questions. 

## My profile (acronym)
A link to get to your own profile, this is where you update your profile. 

## About us
The about us page, the file is located app/content/ and is named about.md feel free to edit this file to according 
your application. 

## Need to know more?
Visit this page to get a copy of the framework this application is built upon. 
<a href="https://github.com/mosbth/Anax-MVC.git">Anax-mvc</a>

## Future work
1. Add more edit options. 
2. Improve security 
3. Improve error / validation presentation 

## Database design: 
![alt tag](https://github.com/edtau/wgtw/blob/master/database.PNG)



