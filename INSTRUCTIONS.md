WP-Indecision (BE)
=============

WP-Indecision is a WordPress plugin that randomly picks a place to visit. 

#### Guidelines ####

1. We encourage you to not use third party code in the plugin (jQuery or small helper libraries are fine).

2. We estimate approximately 2-4 hours to create a functioning version of this plugin. You are free to complete the plugin in more or less time.

3. We will be evaluating your output based on:
    - Functionality: Does it work well.
    - Architecture: How you plan, organize, and implement your code.
    - Features: What you implement besides the literal requirements. 

4. Create a "Readme" file documenting your code and your development process/choices.

5. Once you have completed the plugin, package the plugin files with a dump of the database into a zip file and send it back us.  

#### Plugin Spec ####

1. Text fields for name and address of the place to be added to the list. On click "Add This Place" button adds and saves the new place into the logged in user's list and the database using ajax. Also clears the value from the text fields and restores them to a default state with the placeholders.

2. The "Your Places" list shows the names of all the added places for the loggedin user, and refreshes on add or delete of a place. The delete buttons are on the right of the places names, and also uses ajax to remove them from the DB.

3. On click "Pick a Place" button chooses random place from the list and displays the name and the address in the
"You're Going To" box. Each place should only appear once per page load (Each click should pick a unique place i.e. no repeats).

![WP-Indecision Wireframe](http://fbteamnerd.s3.amazonaws.com/testProject-wpIndecision2.png)
