<template>

    <div class="main">

    <div class="o_list_search_variant">

      <textarea v-model="this.currency.value" placeholder="Enter value"></textarea>
      <br>
      <select v-model="this.currency.name">
        <option disabled value="">Enter value</option>
        <option value="PLN">PLN</option>
        <option value="EUR">EUR</option>
        <option value="USD">USD</option>
      </select>
      <br>
      <button @click="sendRequest()" type="button" >Exchange</button>
      <br>
      <span>Change: {{ this.exchange }}</span>
      <br>
      <button type="button" @click="import()">Import to csv</button>
      <br>
    </div>

    </div>

</template>
<script>
    import httpClient from "../../assets/vue/client/clientHttp";

    export default {
        name: 'Main',
        data() {
            return {
                currency:
                    {
                        name: '',
                        value: 0,
                    },
                exchange:
                    {

                    }
            };
        },
        methods: {
            sendRequest() {
                var dataForm = this.currency

                httpClient({
                    method: 'post',
                    url: 'api/exchange',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    data: dataForm
                }).then((response) => {
                    if (response.status === 200) {
                        console.log(response.data.data)
                        this.exchange = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            },
          import() {
            var dataForm = this.currency

            httpClient({
              method: 'post',
              url: 'api/import',
              headers: {
                'Content-Type': 'application/json'
              },
              data: dataForm
            }).then((response) => {
              if (response.status === 200) {
                console.log(response.data.data)
                this.exchange = response.data.data;
              }
            })
                .catch((error) => {
                  console.log(error);
                });
          },
        },
    }
</script>
