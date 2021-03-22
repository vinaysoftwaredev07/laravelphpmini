## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Vinay Kumar via vinaysoftwaredev07@gmail.com. All security vulnerabilities will be promptly addressed.

## ------------------------------------------------------------------------------------------------

## IMPORTANT

This is for the demonstration,

 - Web Authentication using Laravel ( Admin User )
 - API Authentication via JWT token ( Admin User )
 - OAuth Authentication for server side auth_code and access_token ( Admin User - Pending )


To check with jwt auth need to change the guard from we to api and for creating the oauth token need to install passport and change the guard to api and driver to passport.


## -----------------------------------------------------------------------------------------------


## JWT Token API

Calling Jwt access token

 - /api/jwt/login > To Validate and generate jwt token to get access to the data
 - /api/jwt/me > Getting data with respect to access token provided



## -----------------------------------------------------------------------------------------------

## OAuth2.0 Authentication

After login into the web ( Mean to say with web guard) app authentication with Admin User,

    -- php artisan passport:install ( For installation of personal access client ) 

 - Click on Developer
 - Create Personal Access Token to access the data from API ( Passport has been used for OAuth2.0 )
 - Change the Default guard to API and API Driver to passport
 - /api/user - got the User Details ( Admin User Details )


