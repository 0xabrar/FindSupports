FindSupports
============ 

Allow summoners to find support players near their skill level using the League of Legends API. Currently limited on allowed API calls.    

Repository for FindMeASupport. All of the material has been converted to using PHP and MySQL. All changes for testing should be added to branch develop. If in the process of making multiple changes use a local branch.   

#####Branch Setup
master -> live site  
develop -> localhost testing    
localbranch -> incremental changes

#####Functionality Needed
1. Improve overall visuals.
2. Improve and error check on PlayerSystem
3. Add in details about Twitter, Google Analytics, etc.
4. Show error messages back to users.

#####Sprint Details
Improve and error check on PlayerSystem:
- need to rate limit API calls
- improve checks for when name doesn't exist
- etc.

####Front-end TODO:
- fix footer on index.php
- clean up code for index.php (too many break tags)
- Add region box on index.php
- Need error boxes to display when summoenr doesn't exist, when summoner under lvl 30 or when summoenr is in challenger
- Fiddlesticks in results page needs to be fixed. Cut off from top right and bottom right
- Page needs favicons


#####Changelog
- v2.2 Updated UI and have properly functional calculations. (March 14 2014)
- v2.0 Prototype functionality out. (March 12 2014)
- v1.7 All backend functionality completed to work correctly. (March 8 2014)
- v1.3 Basic functionality with database added. (March 7 2014)  
- v1.2 Player class added working with API. (March 6 2014)
- v1.1 Reorganized material, converted to PHP. (March 5 2014)
- v1.0 Initial material added. (February 17 2014)
