@extends('layouts.app')

@section('content')
<div class="container-fluid bg-3 text-center">
  <div class="row">

  </div>



<div class="row" >




<div class="col-md-2" v-for="shop in shops" >
  <div class="thumbnail" >
    <h3 align="center">@{{shop.name}}</h3>
    <img :src="shop.picture" >
    <div class="caption">
      <a v-bind:href="'/dislike/'+shop.id_oid" role="button" class="btn btn-danger" >Dislike</a>
      <a v-bind:href="'/like/'+shop.id_oid" role="button" class="btn btn-success" style="margin-left:19px" >Like</a>

    </div>
  </div>
</div>









</div>
</div>

@endsection

@section('scripts')
  <script>

    const app = new Vue({
      el: '#app',
      data: {
        shops: {},
        user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},

      },
      mounted() {
        this.getshops();

      },
      methods: {
        getshops() {
          axios.get('/shop')
                .then((response) => {
                  this.shops = response.data
                })
                .catch(function (error) {
                  console.log(error);
                });
        },
      }
    })

  </script>
@endsection
