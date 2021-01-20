# My restaurants App
List restaurants from json file , with some Sorting & Favourites functionalities

## To run the app on docker:
- Clone the repo to your local
- cd into folder.
- Create .env file ---> You can copy .env.example then rename and edit it.
- Run the following command: `docker-compose up --build -d`  (this will build the docker services and run it in background)

- Or run the docker sail up --> [see more info here] (https://laravel.com/docs/8.x/sail#starting-and-stopping-sail)

- To check the status of the running containers, run the following command `docker ps -a`
- To get inside the docker container using this: `docker exec -u 0 -it Container_ID bash`
......

### To open the app:
- App running on your localhost:
`http://localhost:80/`
- `If app not running, execute the (check docker status) mentioned before`

### Tests:
- To be added ..

## App is using:
- Laravel & PHP
- Docker (sail ) --> [Official documentation here (https://laravel.com/docs/8.x/sail).
- Json file in storage folder , loaded in Resturant Service Provider
