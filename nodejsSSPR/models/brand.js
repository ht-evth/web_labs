const { Sequelize, DataTypes, Model } = require('sequelize');
const sequelize = require("../config/db");


class Brand extends Model{}

Brand.init({
	PK_Brand: {
		type: DataTypes.INTEGER,
		primaryKey: true,
		autoIncrement: true, // Automatically gets converted to SERIAL for postgres
	},
	name: {
		type: DataTypes.STRING,
		allowNull: false
	}
}, {
	sequelize,
	modelName: "Brand",
	tableName: "brand"
});


module.exports = Brand
