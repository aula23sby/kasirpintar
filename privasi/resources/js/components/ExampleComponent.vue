<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                       Ini adalah contoh component goooess terusss.<br>
                       mantapp polll<br>
                       {{ title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
    export default {
        mounted() {
            this.$store.commit('SET_TITLE','Hello Laravel, Vue, and Vuex')
        },
        computed: mapState({
            title: state => state.title
        })
    }
</script>
