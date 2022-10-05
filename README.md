# 開発者用質問アプリ
## ポートフォリオ用

### 実装した機能一覧
1. アカウント作成・ログイン機能  
　アカウント作成してデータベース上に保存され、そのデータをもとにメアドとパスワードでログインする機能について、laravel uiを用いて実装した。

2. 件名・タグ・本文の保存機能  
　質問内容における概要を表す件名、その質問内容を記述する本文、質問の種類を表すタグの3種類のデータをデータベース上に保存し、ビューに表示する機能を実装した。

3. タグごとの表示機能  
　質問の送信の際に入力したタグによって、過去の質問内容を分類して表示する機能を実装した。

4. 画像の保存・表示機能  
　質問の送信の際に、上記の3種類の情報と共に画像をアップロードしてデータベース上に保存する機能を実装し、その画像をビュー上に表示する機能も実装した。

5. 件名によるリンク表示  
  チュートリアルで作成した時点では、更新画面のリンクの名前を本文の内容にしていたが、長くなってしまうため、件名に置き換えてこの問題を解決した。

6. 質問に対する回答とフィードバックの返信機能  
  これにより、質問者が自身の悩みを言語化して理解する事で、開発力向上を図る事が出来る。

7. フィードバックした説明文に対するレビュー機能  
  具体的に1-5の5段階評価を行うが、その平均値を一人一人のマイページに表示する事で、回答者側も自身の回答方法を見直す事が出来、回答の質の向上を図ることが出来る。

8. レビューの平均値のユーザーごとの一覧機能  
  これにより、一人一人の回答の質を比較されるため、「もっと良い回答をしよう」というモチベーションが湧き、結果として回答の質が向上する事で質問者の理解度がより向上すると考えた。
