var express = require("express"),
app = express(),
path = require("path"),
routes = require('./routes/routes');
bodyParser = require('body-parser')


app.use(express.static(path.join(__dirname, "public")));
app.use(bodyParser.urlencoded({extended:true}));
app.use(bodyParser.json());

app.set("view engine", "ejs");
app.set("views", path.join(__dirname, "views"));



//connecting to database
const db = require("./config/db");
db.authenticate()
	.then(function() {
		console.log("Успешное подключение к БД");
	})
	.catch((err) => console.log(err));


//подключение маршрутизации
app.use("/", routes);



app.listen(3000,function () {
    console.log("Слушаем порт 3000");
});
