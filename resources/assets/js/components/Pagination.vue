<template>
    <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#" @click.prevent="">&laquo;</a></li>

        <li> <a href="#" @click.prevent="pageChanged(1)" aria-label="First">&laquo;</a></li>
        <li> <a href="#" @click.prevent="pageChanged(page-1)" aria-label="Previus">&lt;</a></li>

        <li v-for="n in paginationRange">
            <a href="#" @click.prevent="pageChanged(n)">{{n}}</a>
        </li>

        <li> <a href="#" @click.prevent="pageChanged(page+1)" aria-label="Next">&gt;</a></li>
        <li> <a href="#" @click.prevent="pageChanged(lastPage)" aria-label="Last">&raquo;</a></li>




        <li><a href="#">&raquo;</a></li>
    </ul>
</template>
<style>

</style>
<script>
export default {
    data(){
        return {
            page:1
        }
    },
    props: {
        // Current Page
            currentPage: {
              type: Number,
              required: true
            },
            // Total page
            totalPages: Number,
            // Visible Pages
            visiblePages: {
              type: Number,
              default: 5,
              coerce: (val) => parseInt(val)
            }
    },
    methods: {
          lowerBound (num, limit) {
            return num >= limit ? num : limit
          },

          pageChanged (pageNum){
            if (pageNum <=1) pageNum=1
            if (pageNum>=this.lastPage) pageNum=lastPage
            this.page
            this.$emit('page-changed', pageNum)
          },
    },

    computed: {
        lastPage () {
          if (this.totalPages) {
            return this.totalPages
          } else {
            return this.totalItems % this.itemsPerPage === 0
              ? this.totalItems / this.itemsPerPage
              : Math.floor(this.totalItems / this.itemsPerPage) + 1
          }
        },
        paginationRange () {
              let start = this.currentPage - this.visiblePages / 2 <= 0
                            ? 1 : this.currentPage + this.visiblePages / 2 > this.lastPage
                            ? this.lowerBound(this.lastPage - this.visiblePages + 1, 1)
                            : Math.ceil(this.currentPage - this.visiblePages / 2)
              let range = []
              for (let i = 0; i < this.visiblePages && i < this.lastPage; i++) {
                range.push(start + i)
              }
              return range
            }
    }
}
</script>
