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
      <a v-bind:href="'/'+shop.id" role="button" class="btn btn-danger" value="" >Remove</a>

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
        this.getlikedshops();

      },
      methods: {
        getlikedshops() {
          axios.get('/liked')
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
