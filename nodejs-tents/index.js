var http = require('http');
var fs = require('fs');

var server = http.createServer(function(req, res) {
  console.log("URL страницы: " + req.url)

  if (req.url === '/' || req.url === '/index')
  {
    console.log("aaaaaaaaaaaaa: ")
    res.writeHead(200, {'Content-type': 'text/html; CHARSET=utf-8'});
    fs.createReadStream(__dirname + '/index.html').pipe(res);
  }


});

server.listen(3000, '127.0.0.1');
console.log("Мы отслеживаем порт 3000");
