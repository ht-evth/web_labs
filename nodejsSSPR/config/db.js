const { Sequelize } = require('sequelize');
module.exports = sequelize = new Sequelize('tents', 'root', '', {
	dialect: 'mysql',
	host: "127.0.0.1",
    logging: false,
    define: {
    	timestamps: false
    }
});
