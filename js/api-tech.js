window.TechAPI = {
  cache: null,

  async init() {
    if (!this.cache) {
      const res = await fetch('/wp-json/control-wheel/v1/tech');
      this.cache = await res.json();
    }
    console.log(this.cache);
    return this.cache;
  },

  getAll() {
    return this.cache;
  }
};