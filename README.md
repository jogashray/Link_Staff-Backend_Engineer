## Follow the instructions to install the project 
- clone the project **git clone https://github.com/jogashray/Link_Staff-Backend_Engineer.git**
- go to project directory **cd Link_Staff-Backend_Engineer**
- install the composer **composer install**
- change the file name .env.example to .env
- set database info (name, password, host, port etc)
- run **php artisan key:generate**
- run **php artisan migrate**
- run **php artisan passport:install**
- run **php artisan serve**

# Given the available API endpoints

## 1. Register
    HTTP Method : POST
    
    URL: api/auth/register
    Request body: [ first_name (string)*, last_name (string), email (email)*, password (password)* ] 
    Response: person data with Bearer authorization token (json format)
    
## 2. Login
    HTTP Method : POST
    
    URL: api/auth/login
    Request body: [ email*, password* ] 
    Response: person data with Bearer authorization token (json format) 
  
## 3. Page Create
    HTTP Method : POST
    Authorization : <Bearer token>
    
    URL: api/page/create
    Request body: [ page_name (string) ] 
    Response: 200
    
## 4. Follow Person
    HTTP Method : PUT/POST
    Authorization : <Bearer token>
    
    URL: api/follow/person/{personId}
    Response: 200
   
## 5. Follow page
    HTTP Method : PUT/POST
    Authorization : <Bearer token>
    
    URL: api/follow/page/{pageId}
    Response: 200
    
## 6. Attached post by Person
    HTTP Method : POST
    Authorization : <Bearer token>
    
    URL: api/person/attach-post
    Request Body: [ post_content(string) ]
    Response: 200
   
## 7. Publish a post to the page
    HTTP Method : POST
    Authorization : <Bearer token>
    
    URL: api/page/{pageId}/attach-post
    Request Body: [ post_content(string) ]
    Response: 200
    
## 8. Get the feeds of logged in person
    HTTP Method : GET
    Authorization : <Bearer token>
    
    URL: api/person/feed
    Response: feed lists (json format)