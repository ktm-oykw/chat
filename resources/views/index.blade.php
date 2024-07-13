
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Chat
    </h2>
  </x-slot>
  
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-500 border-b border-gray-200">
                  
          
    {{-- ユーザーリストを表示 --}}
    <ul>
      @foreach ($hitobito as $akaunnto)
           <li>
               <a href="/chat/{{ $akaunnto->id }}">{{ $akaunnto->name }}とチャットする</a>
          </li>
      @endforeach
    </ul>
    
   
    <form method="post" action="" onsubmit="return false;">
        メッセージ : <input type="text" id="input_message" autocomplete="off" />
        <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
    </form>

    
    <ul class="list-disc" id="list_message">
        <li><strong>太郎</strong><div>こんにちは</div></li>
        <li><strong>次郎</strong><div>ハロー</div></li>
        <li><strong>三郎</strong><div>こんばんわ</div></li>
    </ul>

                </div>
            </div>
        </div>
    </div>              
  
    {{ Auth::user()->name }}
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
  
</x-app-layout>