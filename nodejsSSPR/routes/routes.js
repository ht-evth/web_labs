var Tent = require('../models/tent'),
    Category = require('../models/category'),
    Brand = require('../models/brand');

var express = require('express'),
    router = express.Router(),
    path = require('path'),
    ejs = require("ejs"),
    multer  = require('multer');

//устснавливаем хранилище для изображений
var storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, './public/saved_imgs/');
  },
  filename: function (req, file, cb) {
    cb(null, Date.now() + file.originalname);
  }
});


var upload = multer({ storage: storage });


// главная
router.get('/', function(req, res, next) {
    res.render("index", {title:"Главная"});
});

router.get('/index', function(req, res, next) {
    res.render("index", {title:"Главная"});

});


// каталог палаток
router.get('/catalog', function(req, res) {
    Tent.findAll({
        include: [
            {model: Brand},
            {model: Category}
          ]
    }).then(data =>
    {
        res.render("catalog", {title:"Каталог", tents: data});
    }).
    catch(err => console.log(err));
});

// просмотр конкретного продукта
router.get('/productinfo_:id', function(req, res) {
    Tent.findOne({
        include: [
            {model: Brand},
            {model: Category},
          ],
        where: {
            PK_Tent: req.params.id
        }
    }).then(data =>
    {
        res.render("productinfo", {title:"Подробности продукта", thisTent: data});
    })
    .catch(err => console.log(err));
});

//удаление
router.post('/delete_:id', async function(req, res) {
    await Tent.destroy({
        where: {
            PK_Tent : req.params.id
        }
    });
    res.redirect("/pageadmin");
});

//добавление нового продукта
router.get('/createtent', async function (req, res) {
    var brands = await Brand.findAll();
    var categories = await Category.findAll();
    res.render('productedit', {title: "Добавить палатку", curObj: {}, brands: brands, categories: categories});
});


router.post('/createtent', upload.single('wallpaper'), async function(req, res) {
    if(req.file)
        var pathInSystem = req.file.path.replace(/^public/, '');
    else
        var pathInSystem = "";
    var obj = await Tent.create({
        PK_Brand : req.body.brand,
        PK_Category : req.body.category,
        name : req.body.name,
        price: req.body.price,
        weight: req.body.weight,
        places: req.body.places,
        doors: req.body.doors,
        windows: req.body.windows,
        description : req.body.description,
        image_path : pathInSystem

    }).then(function (Tents) {
        if(!Tents)
        {
            res.status(400).send("ERRORs");
        }
    });
    res.redirect('/pageadmin');
});

//обновление существующего продукта
router.get('/updatetent_:id', async function(req,res) {
    var brands = await Brand.findAll();
    var categories = await Category.findAll();

    var temp = await Tent.findOne({
            where: {
                PK_Tent: req.params.id
            }
        }).then(data => {
        res.render("productedit", {title: "Редактировать палатку",
                                    curObj : data,
                                    brands : brands,
                                    categories: categories,
                                    })
    })
    .catch(err => console.log(err));


});

router.post('/updatetent_:id', upload.single('wallpaper'), async function(req,res) {
    if(req.body.pk_tent)
    {
      console.log("req.body.pk_tent");
        if(req.file)
            var pathInSystem = req.file.path.replace(/^public/, '');
        else
            var pathInSystem = "";
        var obj = await Tent.update({
          PK_Brand : req.body.brand,
          PK_Category : req.body.category,
          name : req.body.name,
          price: req.body.price,
          weight: req.body.weight,
          places: req.body.places,
          doors: req.body.doors,
          windows: req.body.windows,
          description : req.body.description,
          image_path : pathInSystem
        },{
            where: {PK_Tent : req.body.pk_tent}
        });
      }

    res.redirect('/pageadmin');
})


//админ-каталог
router.get('/pageadmin', function(req, res) {
  Tent.findAll({
      include: [
          {model: Brand},
          {model: Category}
        ]
    }).then(data =>
    {
        res.render("pageadmin", {title:"Администрирование каталога", tents: data});
    }).
    catch(err => console.log(err));

});


router.use(function(req, res, next) {
    res.status(404).send('<h1>Ошибка 404<br> Такую страницу мы ещё не придумали!</h1>');
});

module.exports = router;
