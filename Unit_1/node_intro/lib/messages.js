const sanitizeHTML = require('sanitize-html');

module.exports = function(url,callback){
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
    }
  );

  const Message = mongoose.model(
    'messages',
    MessageSchema
  );

  return {
    create:function(newMessage,callback){
      const message = new Message(newMessage);
      message.save(callback);
    },
    read:function(id,callback){
      Message.findById(id).exec(callback);
    },
    readUsername:function(username,callback){
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
