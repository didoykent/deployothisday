@extends('layouts.master')






@section('content')




<div class="col-md-9">

<div v-for = "message in messages">

<h2>@{{message.name}} : @{{message.message}}</h2>
</div>


<input type="text" placeholder="Start typing your message..." v-model="messageText"  @keyup.enter="sendMessage(messages)">
<button class="btn btn-primary"  v-on:messagesent="addMessage(Messages)" @click="sendMessage">Send</button>



</div>



@endsection
