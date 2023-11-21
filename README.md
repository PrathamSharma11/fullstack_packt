# fullstack_packt
PACKT_Assessment

FullStack Assessment in vue.js and laravel  where admin can add , delete and update Books and its information related to books and can also search books based on its name,description,author,genre,isbn.


Installation=
Download the zip file from git hub inside(fullstack_packt) unzip it and open it on vs code after that do all the installations=
:IN LARAVEL FOLDER= 
1)install php
2)install composer = Download and run Composer-Setup.exe
3)install laravel = composer create-project laravel/laravel
4)in your .env file change the database name to fullstack_packt
5)in the terminal run = php artisan serve and open the localhost on browser and start the apache and mysql server
6)go to routes/api file and you can see all the api's, after that go to postman and put the api's on search bar and smash the send button than you can see every api's positive result.
7) for searching i have USED ELASTIC Search so, to enable searching install this = composer require laravel/scout,php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider" ,while testing the api you have to put ?search={input} in the end of api to get the result in postman



:IN VUE FOLDER's Terminal
1)INSTALL Node.js
2)npm init vue@latest - no to everything except single page app development
3)npm install
4)npm i bootstrap@5.3.2 - import in main.css inside assets folder
5)npm run dev



after npm run dev in terminal you should click on the localhost link and it gets open on browser and from there you can see the entire project and can navigate as per you wish.

:you will see like this after all the installation(all line wise screen shots as an user point of view)

![Screenshot (224)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/e92e388a-f1f6-49bd-865e-f33f14a77e8a)
![Screenshot (225)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/53394b6e-d64a-428f-9b80-d5031ddd845a)
![Screenshot (226)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/1c672a50-d586-4350-b758-c4ae754326f3)
![Screenshot (227)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/a1dcec44-c6f1-4e2e-b8ff-ee44defc9e7b)
![Screenshot (228)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/780877e8-0508-4715-bb1a-129386db51a7)
![Screenshot (229)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/e70daf44-3b42-468c-8adb-e2e9c385e361)
![Screenshot (230)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/9510b3c8-c546-4b8c-8ae4-e4587b758c5b)
![Screenshot (231)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/170a50ff-e355-4b34-a3b3-c4b1422282d5)
![Screenshot (232)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/196fae35-b03f-44ca-bbe9-7aa490acf510)
![Screenshot (233)](https://github.com/PrathamSharma11/fullstack_packt/assets/78479210/2db6eac6-2cfb-4a7a-b8a1-7175f1fbc377)











