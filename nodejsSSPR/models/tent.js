const { Sequelize, DataTypes, Model } = require('sequelize');
const sequelize = require("../config/db");

var Brand = require("./brand");
var Category = require("./category");


class Tent extends Model{}


Tent.init({
	PK_Tent: {
		type: DataTypes.INTEGER,
		primaryKey: true,
		autoIncrement: true,
	},
	name: {
		type: DataTypes.STRING,
		allowNull: false
	},
	price: {
		type: DataTypes.DECIMAL(15, 2),
		allowNull: false
	},
	weight: {
		type: DataTypes.DECIMAL(5, 2),
		allowNull: false
	},
	places: {
		type: DataTypes.INTEGER,
	},
	doors: {
		type: DataTypes.INTEGER,
	},
	windows: {
		type: DataTypes.INTEGER,
	},
	description: {
		type: DataTypes.TEXT,
	},
	image_path: {
		type: DataTypes.STRING
	},
	PK_Category: {
		type: DataTypes.INTEGER,
		allowNull: false
	},
	PK_Brand: {
		type: DataTypes.INTEGER,
		allowNull: false,
	}
},{
	sequelize,
	modelName:'Tent',
	tableName: "tent",
});


Brand.hasMany(Tent, {
	foreignKey: "PK_Brand"
});
Tent.belongsTo(Brand,
{
	foreignKey: "PK_Brand"
});

Category.hasMany(Tent, {
	foreignKey: "PK_Category"
});
Tent.belongsTo(Category,
{
	foreignKey: "PK_Category"
});

module.exports = Tent;
