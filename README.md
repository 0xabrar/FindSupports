FindSupports
============ 

Allow summoners to find support players near their skill level using the League of Legends API. Currently limited on allowed API calls.    

Repository for FindMeASupport. All of the material has been converted to using PHP and MySQL. All changes for testing should be added to branch develop. If in the process of making multiple changes use a local branch.   

#####Branch Setup
master -> live site  
develop -> localhost testing    
localbranch -> incremental changes

#####Functionality Needed
2. Include relevant information to compare summoner skills.
3. Add in MySQL database.
4. Interact with MySQL database.
5. Improve overall visauls.
6. Create a script to aid in populating the database.

#####Sprint Details
Add in MySQL database:
- create separate class for working with the database
- complete player database constructor
- determine some way decide whether to construct with API or database
- add local database

#####Changelog  
- v1.2 Player class added working with API. (March 6 2014)
- v1.1 Reorganized material, converted to PHP. (March 5 2014)
- v1.0 Initial material added. (February 17 2014)
