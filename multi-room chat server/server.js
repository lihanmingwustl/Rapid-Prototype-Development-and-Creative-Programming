// Require the packages we will use:
var http = require("http"),
	socketio = require("socket.io"),
	fs = require("fs");

// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp){
	// This callback runs when a new connection is made to our HTTP server.

	fs.readFile("client.html", function(err, data){
		// This callback runs when the client.html file has been read from the filesystem.

		if(err) return resp.writeHead(500);
		resp.writeHead(200);
		resp.end(data);
	});
});
app.listen(3456);

var users = {};
var rooms = ['Lobby'];
var AllRooms = {'Lobby':''};
var bannedUsers = {};
var owners = {};

// Do the Socket.IO magic:
var io = socketio.listen(app);
io.sockets.on("connection", function(socket){
	// This callback runs when a new Socket.IO connection is established.
  	socket.on('message_to_server', function(data) {
  		// This callback runs when the server receives a new message from the client.
  		console.log("message: "+data["message"]); // log it to the Node.JS output
        var msg = data["message"];
        //emit it only to people in the room
        io.sockets.in(socket.room).emit("message_to_client", socket.username, msg);
    });
    
    
//if we are going to have a new user, we first get his username, and put him into the lobby room.
  socket.on("add_user", function(username){
      socket.room = 'Lobby';
      socket.username = username;
      users[username] = socket.room;//record (username:room)
      socket.join('Lobby');//let the user go to lobby room first.
      console.log("Add User " + username); 
	  socket.emit('update_add_room', socket.room,rooms);
      io.sockets.in(socket.room).emit('update_users', users,socket.room);
      socket.broadcast.to('Lobby').emit('update_chatlog', username, 'connects to the chat room now');
  });


  socket.on("add_room", function(owner,room, pass){
    AllRooms[room] = pass;//put this room into AllRooms ARRAY;
    rooms.push(room);////put this room into AllRooms ARRAY;
	owners[room] = owner;//record the owner of this room;
    io.emit('update_add_room', room, rooms);//
  });
  
  
  

  socket.on("pwd_lookup", function(room){
    var password = AllRooms[room];
    socket.emit("switch_room", room, password);
  });
  
  

  socket.on("switch_room", function(newroom){
		
        
	var old = socket.room;
    
    socket.leave(old);
    socket.broadcast.to(socket.room).emit('update_chatlog', socket.username, ' left the room.');
    io.sockets.in(old).emit('update_users', users,old);
    
    socket.join(newroom);
    
    users[socket.username] = newroom;
    socket.room = newroom;
    socket.broadcast.to(newroom).emit('update_chatlog', socket.username, 'connects to the chat room now');
	io.sockets.in(socket.room).emit('update_users', users,socket.room); 
        
  });
  
  

	socket.on("privateMessage", function(target, msg, sender){
	   if(users[target] == socket.room){
			socket.broadcast.to(socket.room).emit('directMsg', target, msg, sender);
		}
	});

    
    
	socket.on("kick", function(target, source){
	 	if(source == owners[socket.room]){
			io.sockets.in(socket.room).emit('kickOut', target);
			users[target] = 'Lobby';
		 }
		else{
			console.log("You don't have permission to kick");
		}
	});
    
    

	socket.on("ban", function(target, source){
        
		if(source == owners[socket.room]){
			io.sockets.in(socket.room).emit('banOut', target, socket.room);
			users[target] = 'Lobby';
		}
		else{
			console.log("Sorry, you don't have permission to ban that person!");
		}
        bannedUsers[socket.room]=target;
	});

	socket.on("grant", function(target, grantFrom){
		if(owners[socket.room]== grantFrom ){ 
			owners[socket.room] = target; 
			console.log("Owner of " + socket.room + " is " + target+" now");
		}
		else{ 
			console.log("Sorry, you don't have permission to grant");
		}
	});

});