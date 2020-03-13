const express = require("express");
const models = require("./models");
// const handlebars = require("express-handlebars");

const app = express();
const PORT = process.env.PORT || 8080;

const db = require("./models");

app.use(express.urlencoded({ extended: true }));
app.use(express.json());
// app.engine("handlebars", handlebars({ defaultLayout: "main" }));
// app.set("view engine", "handlebars");

app.use(express.static("./views/layouts"));
app.use(express.static(__dirname + "/public"));

// require("./routes/api-routes.js")(app);
// require("./routes/html-routes.js")(app);

db.sequelize.sync().then(function() {
    app.listen(PORT, function() {
        console.log("App listening on PORT " + PORT);
    });
});
