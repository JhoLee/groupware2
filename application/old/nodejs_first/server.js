const http = require('http');
const port = 1337;

const server = http.createServer(function (request, response) {

    response.writeHead(200, {'Content-type': 'text/html'});
    response.end('Hello node.js!!');


});

server.listen(port, () => {
    console.log(`Server is running... "port: ${port}"`);
});