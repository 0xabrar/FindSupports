FindSupports
============ 

Allow summoners to find support players near their skill level using the League of Legends API. Currently limited on allowed API calls.    

Repository for FindMeASupport. All of the material has been converted to using PHP and MySQL. All changes for testing should be added to branch develop. If in the process of making multiple changes use a local branch.   

#####Branch Setup
master -> live site  
develop -> localhost testing    
localbranch -> incremental changes

#####Functionality Needed
3. Improve and error check on PlayerSystem.
4. Integrate html and php material.
5. Improve overall visauls.
6. Create a script to aid in populating the database.

#####Sprint Details
Improve and error check on PlayerSystem:
- mmr calculation will screw over on large dataset, improve
- maybe add in some basic unittesting
- make sure nothing breaks with some weird edge case shit

Integrate html and php material:
- all material provided as an interface from getter functions
- add in materials from playersystems to results.php page
#####Changelog
- v1.7 All backend functionality completed to work correctly. (March 8 2014)_
- v1.3 Basic functionality with database added. (March 7 2014)  
- v1.2 Player class added working with API. (March 6 2014)
- v1.1 Reorganized material, converted to PHP. (March 5 2014)
- v1.0 Initial material added. (February 17 2014)
