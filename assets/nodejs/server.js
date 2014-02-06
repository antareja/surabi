var http = require('http');
var url = require("url");
http=http.createServer(function(request, response) {
response.writeHead(200, {"Content-Type": "text/plain"});
var pathname = url.parse(request.url,true);
var queryAsObject = pathname.query;
response.end();
console.log(queryAsObject);
updateSockets({data: queryAsObject});
}).listen(8000);
var  io = require('socket.io').listen(http);
var connectionsArray = [];


// creating a new websocket to keep the content updated without any AJAX request
io.sockets.on('connection', function(socket) {

  console.log('Number of connections:' + connectionsArray.length);


  socket.on('disconnect', function() {
    var socketIndex = connectionsArray.indexOf(socket);
    console.log('socket = ' + socketIndex + ' disconnected');
    if (socketIndex >= 0) {
      connectionsArray.splice(socketIndex, 1);
    }
  });

  console.log('A new socket is connected!');
  connectionsArray.push(socket);

});

var updateSockets = function(data) {
  // sending new data to all the sockets connected
  connectionsArray.forEach(function(tmpSocket) {
    tmpSocket.volatile.emit('notification', data);
  });
};
