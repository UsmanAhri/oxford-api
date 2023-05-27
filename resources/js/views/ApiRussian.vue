<template>
  <template v-if="this.$route.query.q">
    <div class="t-block t-block__api" v-if="!loading && result">
      <template v-if="typeof result !== 'string'">
        <div class="t-block__left">
          <div class="t-block__word">
            <p v-text="'Translations'"/>
          </div>
          <div class="t-block__word">
            <p v-text="'Examples'"/>
          </div>
        </div>
        <div class="t-block__right">
          <div class="t-block__word">
            <p v-text="result.translations.length ? result.translations[0].text : `Sorry! There is no translations for '${result.word}' word.`"/>
          </div>
          <div class="t-block__word">
            <p
                v-for="(example, key) in result.examples"
                :key="key"
                v-text="`${example.text} - ${example.translations[0].text}`"
            />
          </div>
        </div>
      </template>
      <template v-else>
        <h4 class="results" v-if="!loading && result" v-text="result"/>
      </template>
    </div>
  </template>
  <template v-else>
    <div class="d-flex justify-content-center mt-5">
      <ui-textfield
          v-model="word"
      >
        Search your word
      </ui-textfield>
    </div>
    <h4 class="results" v-if="!loading && result">
      {{ typeof result === 'string' ? result : result.translations[0].text }}
    </h4>
  </template>
  <div class="d-flex justify-content-center me-3" v-if="loading">
    Loading...
  </div>
</template>

<script>
import { debounce, isEmpty } from 'lodash'

export default {
  name: 'ApiRussian',
  data () {
    return {
      word: '',
      result: null,
      loading: false
    }
  },
  mounted () {
    if (this.$route.query.q) {
      this.word = this.$route.query.q
    }
  },
  methods: {
    searchWord: debounce(async function () {
      try {
        this.loading = true

        let { data } = await axios.get('/api/specific_word', {
          params: {
            language: 'ru',
            word: this.word
          }
        })

        this.result = !isEmpty(data) ? data : 'Nothing found!'
      } catch (e) {
        this.result = 'Something went wrong!'
      } finally {
        this.loading = false
      }
    }, 1000)
  },
  watch: {
    word (value) {
      if (value.length >= 3) {
        this.searchWord()
      }
    }
  }
}
</script>

<style scoped>
.results {
  text-align: center;
  margin-top: 30px;
}
</style>