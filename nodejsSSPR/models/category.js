const { Sequelize, DataTypes, Model } = require('sequelize');
const sequelize = require("../config/db");


class Category extends Model{}

Category.init({
	PK_Category: {
		type: DataTypes.INTEGER,
		primaryKey: true,
		autoIncrement: true,
	},

	name: {
		type: DataTypes.STRING,
	}

}, {
	sequelize,
	modelName: 'Category',
	tableName: "category"
})

module.exports = Category
