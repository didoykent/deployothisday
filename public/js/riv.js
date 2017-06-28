Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({

  el: '#riv-vue',

  data: {



newClient: {'clientName': '', 'clientType': '', 'clientAge': '', 'clientBday': '', 'clientCN': '', 'clientSpouse': '', 'clientJob': ''},

editClient: {'clientName': '', 'clientType': '', 'clientAge': '', 'clientBday': '', 'clientCN': '', 'clientSpouse': '', 'clientJob': '', 'id' : ''},

newItem: {'itemName': '', 'itemSrp': '', 'itemQuantity': '', 'itemImagePath': ''},

editItem: {'itemName': '', 'itemSrp': '', 'itemQuantity': '', 'itemImagePath': '', 'id': ''},

editUser: {'newpassword': '', 'confirmpassword': '', 'id': '', 'name': '', 'position': ''},

editStatus: {'name': '', 'status': '', 'position': '', 'id': ''},

ifSale: false,

ifError: false,



Messages: [{'name' :'john', 'message': 'me'}, {'name': 'mow', 'message': 'lah'}],

TempMessages: {'name': 'Love', 'message': ''},



editSale: {'itemName': '', 'itemSrp': '', 'itemDiscount': '', 'title': '', 'id': '' },





totalCartItems: '',

cartitems:[],









formErrorsItemEdit: {},

formErrorsUserEdit: {},



formErrors: {},
formErrorsItem:{},

formErrorsEdit: {}

  },


  ready: function(){


this.$http.get('/riv-admin/handleApi').then((response)=>{

if(response.data  == "positionrivadmin"){

  this.fetchUsers();
  this.fetchClients();
    this.getUserClients();
    this.getAdminReports();
    this.getUpdateReports();
    this.getRemovedReports();
    this.salehandle();
    this.manageUsersData();
    this.getSaleReports();
    this.getsummaryRep();
    
    this.getSummdailyRep();
    this.getCount();
}

});




    this.fetchItems();

    this.fetchCartItems();
    this.CartItems();






  },

  methods:{

fetchUsers:function(){

this.$http.get('/riv-admin/getusers').then((response)=>{

this.$set('users', response.data);
});

},

fetchClients:function(){

this.$http.get('/riv-admin/getclients').then((response)=>{

this.$set('clients', response.data);

});

},


getCount:function(){

this.$http.get('/riv-admin/getcount').then((response)=>{

this.$set('userscount', response.data.users);
this.$set('clientscount', response.data.clients);
this.$set('itemscount', response.data.items);

});

},


addItem: function(){

var newinput = this.newClient;

this.newClient = {'clientName': '', 'clientType': '', 'clientAge': '', 'clientBday': '', 'clientCN': '', 'clientSpouse': '', 'clientJob': ''};

this.$http.post('/riv-admin/getclients', newinput).then((response)=>{

this.fetchClients();
this.getCount();
this.getsummaryRep();
toastr.success('Successfully Created', 'Client');


},(response)=>{

this.formErrors = response.data
});

},



ShowClient: function(client){

this.editClient.id = client.id;
this.editClient.clientName = client.clientName;
this.editClient.clientType = client.clientType;
this.editClient.clientAge = client.clientAge;
this.editClient.clientBday = client.clientBday;
this.editClient.clientCN = client.clientCN;
this.editClient.clientSpouse = client.clientSpouse;
this.editClient.clientJob = client.clientJob;


$('#edit-item').modal ('show');
},


updateItem: function(id){

var newinput = this.editClient;

this.$http.put('/riv-admin/getclients/'+id, newinput).then((response)=>{


this.fetchClients();
  this.getsummaryRep();


$('#edit-item').modal ('hide');
toastr.success('Successfully Updated', 'Client');
},(response)=>{

this.formErrorsEdit = response.data;
});


},

DeleteClient: function(id){

var isconfirmDelete = confirm('are you sure you want to delete this client?');

if(isconfirmDelete)
this.$http.delete('/riv-admin/getclients/'+id).then((response)=>{


this.fetchClients();
this.getCount();
  this.getsummaryRep();
  toastr.success('Successfully Removed', 'Client');
});


},


fetchItems:function(){


  this.$http.get('/riv-admin/getitems').then((response)=>{

    this.$set('items', response.data);
  });
},

createItem: function(){

var newinput = this.newItem;
this.$http.post('/riv-admin/getitems', newinput).then((response)=>{

this.newItem = {'itemName': '', 'itemSrp': '', 'itemQuantity': '', 'itemImagePath': ''};


this.fetchItems();
this.getCount();
  this.getsummaryRep();
  toastr.success('Sucessfully Created', 'Item');
},(response)=>{

this.formErrorsItem = response.data;

});

},



ShowItem: function(item){


this.editItem.id = item.id;
this.editItem.itemName = item.itemName;
this.editItem.itemSrp = item.itemSrp;
this.editItem.itemQuantity = item.itemQuantity;
this.editItem.itemImagePath = item.itemImagePath;

$('#new-edititem').modal('show');

},


patchItem: function(id){

var newinput = this.editItem;
this.$http.put('/riv-admin/getitems/'+id, newinput ).then((response)=>{

this.fetchItems();
  this.getsummaryRep();


toastr.success('Sucessfully Updated', 'Item');
$('#new-edititem').modal('hide');
},(response)=>{

this.formErrorsItemEdit = response.data;

});


},

DeleteItem: function(id){

  var isconfirmDelete = confirm('are you sure you want to delete this data?');

  if(isconfirmDelete)
  this.$http.delete('/riv-admin/getitems/' +id).then((response)=>{

    this.fetchItems();
    this.getCount();
      this.getsummaryRep();
      toastr.success('Sucessfully Removed', 'Item');
  });
},



getUserClients: function(){


this.$http.get('/riv-admin/getUserClients').then((response)=>{


this.$set('newclients', response.data);


});

},




AddCart: function(item){


var client = this.city;
this.$http.get('/riv-admin/addcart/'+ item.id).then((response)=>{







  this.fetchCartItems();

  this.$http.get('/riv-admin/handleApi').then((response)=>{

  if(response.data  == "positionrivadmin"){
    this.getsummaryRep();

}
});


toastr.success('Successfully Added to Cart', "Item")
});



},


clientCart: function(item){


var client = this.city;
this.$http.get('/riv-admin/clientcart/'+ item.id + '/' + client).then((response)=>{







  this.fetchCartItems();
    this.getsummaryRep();
    toastr.success('Successfully Added to Cart', "Item")
});



},


fetchCartItems:function(){

  this.$http.get('/riv-admin/fetchCart').then((response)=>{

this.totalCartItems = response.data;




  });
},


CartItems:function(){

this.$http.get('/riv-admin/CartItems').then((response)=>{

this.$set('cartitems', response.data );
this.$set('cartotalPrice', response.data.totalPrice);
this.$set('shippingFee', response.data.shippingFee);
this.$set('onlineCartTotal', response.data.onlineCartTotal);



});

},


reduceByOne:function(carts){

var id = carts['item']['id'];

this.$http.get('/riv-admin/reduceItem/'+ id).then((response)=>{


var getdata = response.data;
if(getdata == true){

  location.reload();
}
this.CartItems();

this.fetchCartItems();

});

},




increaseByOne:function(carts){

var id = carts['item']['id'];

this.$http.get('/riv-admin/increaseItem/'+ id).then((response)=>{

this.CartItems();

this.fetchCartItems();

});

},




removeAll:function(carts){

var id = carts['item']['id'];

this.$http.get('/riv-admin/removeItem/'+ id).then((response)=>{
  var getdata = response.data;

  if(getdata == true){

    location.reload();
  }

this.CartItems();

this.fetchCartItems();

  toastr.success('Sucessfully removed to Cart', 'Item');

});

},


insertCash:function(){

  var cash = this.cash;

  this.$http.get('/riv-admin/getCash/'+ cash).then((response)=>{

this.$set('totalCash', response.data.totalCash);
this.$set('totalChange', response.data.totalChange);
this.$set('salestax', response.data.salestax);
this.$set('finaltotal', response.data.finaltotal);

      this.$set('solditems', response.data.solditems);

      if(response.data.casherror && response.data.quantityerror == true){

        toastr.error('Out of stock and Insufficient funds');
      }
      else if(response.data.casherror == true){

        toastr.error('Insufficient Funds');
      }
    else  if(response.data.quantityerror == true){
        toastr.warning('Out of Stock');
      }
      else{
toastr.success('CheckOut!')
}
      if(response.data.error == true){

        this.ifError = true;
      }
      else{

        this.ifError = false;
      }
  });


} ,


saleItems: function(){

var sale = this.sale;
this.$http.get('/riv-admin/saleItems/' + sale).then((response)=>{
this.fetchItems();
this.ifSale = true;

  this.getsummaryRep();
var salepercent = response.data.toUpperCase() + "%";
  toastr.success('Sale all Items by ' + salepercent);
});


},


unSaleItems: function(){

this.$http.get('/riv-admin/unSaleItems').then((response)=>{
this.fetchItems();
this.ifSale = false;

    this.getsummaryRep();
      toastr.success('SRP');
});

},

salehandle: function(){

  this.ifSale = true;
  this.ifError = true;
},


iSale:function(item){
this.editSale.id = item.id;
this.editSale.itemName = item.itemName;
this.editSale.itemSrp = item.itemSrp;
this.editSale.itemDiscount = item.itemDiscount;
this.editSale.title = item.itemName;





$('#editSale').modal('show');

},



newSale: function(id){


  var newid = id;

  var getdiscount = this.getdiscount;

this.$http.post('/riv-admin/ISaleItems/'+ id + '/' + getdiscount).then((response)=>{

  this.fetchItems();
    this.getsummaryRep();

  var zodiac = response.data;
  var salepercent = zodiac.toString() + "%";


  toastr.success('Sale by ' + salepercent, this.editSale.itemName.toUpperCase() + " Successfully");
$('#editSale').modal('hide');

});


},


rSale: function(item){

this.$http.get('/riv-admin/IRSaleItems/' + item.id).then((response)=>{
this.fetchItems();
  this.getsummaryRep();
  toastr.success("SRP");
$('#editSale').modal('hide');
});

},


getAdminReports: function(){


this.$http.get('/riv-admin/AdminReports').then((response)=>{

this.$set('admins', response.data);
  this.getsummaryRep();

});

},


getUpdateReports: function(){


  this.$http.get('/riv-admin/getupdates').then((response)=>{

    this.$set('updates', response.data);
      this.getsummaryRep();


  });
},


getRemovedReports: function(){


  this.$http.get('/riv-admin/getremoved').then((response)=>{

this.$set('removed', response.data);
  this.getsummaryRep();



  });
},



getSaleReports:function(){


  this.$http.get('/riv-admin/SaleReports').then((response)=>{

this.$set('saleR', response.data);




  });
},


getSalesData: function(){

  this.$http.get('/riv-admin/CartReports').then((response)=>{


this.$set('salesumrep', response.data);
this.ifError = true;
location.reload();
  });
},


getsummaryRep: function(){

  this.$http.get('/riv-admin/SaleReportsCount').then((response)=>{
this.$set('sumrep', response.data);

  });
},


getdata: function(id){

  var quantity = this.list;

  var zoom = [];

  var test = Object.keys(quantity).length;

  for (var x = 0; x <test; x++) {

                 zoom.push(quantity[x].value);
             }


this.$http.get('/riv-admin/ICart/'+ id + '/' + zoom).then((response)=>{
this.$set('cartitems', response.data);
this.CartItems();
this.fetchCartItems();

});


},


getSummdailyRep: function(){


  this.$http.get('/riv-admin/getSummDailyData').then((response)=>{


    this.$set('dailyrep', response.data);
  });
},


Changepassword:function(user){

  this.editUser.id = user.id;
  this.editUser.name = user.username;
  this.editUser.position = user.position;
$('#user-changepass').modal ('show');
},


myPassword:function(id){

  var getinput = this.editUser;

this.$http.post('/riv-admin/userchangepass/' + id, getinput).then((response)=>{
$('#user-changepass').modal ('hide');
this.editUser =  {'newpassword': '', 'confirmpassword': '', 'id': '', 'name': '', 'position': ''};
toastr.success('Sucessfuly changed!', 'User Password');
}, (response)=>{
this.formErrorsUserEdit = response.data;

});

},

manageUsersData:function(){

  this.$http.get('/riv-admin/manageusersdata').then((response)=>{

this.$set('manageusers', response.data);


  });
},


ChangeStatus:function(user){

this.editStatus.id = user.id;
this.editStatus.name = user.username;
this.editStatus.position = user.position;
this.editStatus.status = user.status;

$('#userStatus').modal('show');

},


banUser:function(id){

  this.$http.get('/riv-admin/BanUser/' + id).then((response)=>{
toastr.warning(' Status has been suspended', this.editStatus.name);
  this.manageUsersData();
$('#userStatus').modal('hide');
  });
},


unBanUser:function(id){

this.$http.get('/riv-admin/UnBanUser/' + id).then((response)=>{
toastr.warning('Status is now Active', this.editStatus.name);
  this.manageUsersData();
$('#userStatus').modal('hide');

});

},

RemoveUser:function(id){
var name = this.editStatus.name;
var isconfirmDelete = confirm('are you sure you want to delete this user?');


if(isconfirmDelete){


  this.$http.get('/riv-admin/RemoveUser/' + id).then((response)=>{

toastr.error('Has Been Removed', name);

    this.manageUsersData();
    $('#userStatus').modal('hide');

  });
}
},


ChatView: function(){

  this.$http.get('/riv-admin/chat').then((response)=>{


  });
},

sendMessage: function(){

  this.$emit('messagesent', {
                 message: this.messageText,
                 user: "John Doe"
             });
             this.messageText = '';


this.addMessage();

},


addMessage: function(message){


this.Messages.push(message);

this.$set('messages', this.Messages);

},
















}












});
