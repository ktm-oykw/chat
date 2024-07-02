<html>
  <head>
    <title>読み上げテスト</title>
    <link rel="icon" href="data:,">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width">
  </head>

  <body>
    <input type="button" value="おはよう。こんにちは。こんばんは。" onclick="start()">
    <br>
    <label for="volume">Volume:</label>
    <input type="range" id="volume" name="volume" min="0" max="1" step="0.1" value="0.75">
    <br>
    <label for="pitch">Pitch:</label>
    <input type="range" id="pitch" name="pitch" min="0" max="2" step="0.1" value="0.7">
    <br>
    <label for="rate">Rate:</label>
    <input type="range" id="rate" name="rate" min="0.1" max="10" step="0.1" value="2.0">
  </body>
</html>

<script>
  const uttr = new SpeechSynthesisUtterance() 
  let k = 0
  let voices = null

  const getVoices = () => {
    return  speechSynthesis.getVoices().filter((v) => v.lang === 'ja-JP')
  }
  voices = getVoices()

  const start = () => {
    voices = getVoices()

    // 発言を作成
    const uttr = new SpeechSynthesisUtterance()

    // 声を選択   
    uttr.voice = voices[k]
    console.log(k, uttr.voice.name)

    // 文章を設定
    uttr.text = "おはよう。こんにちは。こんばんは。"

    // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
    uttr.lang = "ja-JP"

    // 速度 0.1-10
    uttr.rate = parseFloat(document.getElementById('rate').value)

    // 高さ 0-2
    uttr.pitch = parseFloat(document.getElementById('pitch').value)

    // 音量 0-1
    uttr.volume = parseFloat(document.getElementById('volume').value)

    // 再生
    speechSynthesis.speak(uttr)    

    if (k < (voices.length - 1)) {
      k += 1
    } else {
      k = 0
    }
  }
</script>
