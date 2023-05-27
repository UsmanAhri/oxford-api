<template>
  <div class="box">
    <div class="t-block" v-if="!loading">
      <div class="t-block__left">
        <h3 class="t-block__title" v-text="'Transport'"/>
        <div class="t-block__word" v-for="(item, key) in transportWords" :key="key">
          <p v-text="item.translations.length ? item.translations[0].text : `Sorry! There is no translations for '${item.word}' word.`"/>
        </div>
      </div>
      <div class="t-block__right">
        <h3 class="t-block__title" v-text="'Family'"/>
        <div class="t-block__word" v-for="(item, key) in familyWords" :key="key">
          <p v-text="item.translations.length ? item.translations[0].text : `Sorry! There is no translations for '${item.word}' word.`"/>
        </div>
      </div>
    </div>
    <div v-else class="d-flex justify-content-center mt-4">
      Loading...
    </div>
  </div>
</template>

<script>
export default {
  name: 'Russian',
  data () {
    return {
      data: [],
      transportWords: [],
      familyWords: [],
      loading: false
    }
  },
  async created () {
    this.loading = true

    try {
      let { data } = await axios.get('/api/words', { params: { language: 'ru' } })
      this.transportWords = data['Transport']
      this.familyWords = data['Family']
    } finally {
      this.loading = false
    }
  }
}
</script>

<style scoped>
.box {
  display: flex;
  justify-content: center;
  margin: auto;
}
</style>