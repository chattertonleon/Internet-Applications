module.exports = function(url,callback){
  const sanitizeHTML = require('sanitize-html');
  const mongoose = require('mongoose');
  mongoose.connect(url,callback);

  const MessageSchema = new mongoose.Schema(
    {
      username:{
        type:String,
        required:true
      },
      text:{
        type:String,
        required:true
      }
    },
    {strict:'throw'}
  );

  const Message = mongoose.model(
    'messages',
    MessageSchema
  );

  return {
    create:function(newMessage,callback){
      try{
        var message = new Message(newMessage);
      } catch(exception){
        return callback('Unable to create entry: invalid number of entries in input');
      }
      if (message.username) message.username = sanitizeHTML(message.username);
      if (message.text) message.text = sanitizeHTML(message.text);
      message.save(callback);
    },
    read:function(id,callback){
      Message.findById(id).exec(callback);
    },
    readUsername:function(username,callback){
      if (typeof(username) !== 'string'){
        return callback('Username not convertible to string');
      }
      Message.find({username:username}).exec(callback);
    },
    readAll:function(callback){
      Message.find({}).exec(callback);
    },
    update:function(id,updatedMessage,callback){
      Message.findByIdAndUpdate(id,updatedMessage,callback);
    },
    delete:function(id,callback){
      Message.findByIdAndRemove(id,callback);
    },
    deleteAll:function(callback){
      Message.remove({},callback);
    },
    disconnect:function(){
      mongoose.disconnect();
    }
  };
};
