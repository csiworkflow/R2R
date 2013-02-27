## ステータス管理

案件のステータス管理を行う画面です。ステータスは以下の3つのステータスがあります。

- <?php echo __('AuthorStatus'); ?>
- <?php echo __('PublisherStatus'); ?>
- <?php echo __('CoauthorStatus'); ?>

それぞれのステータスの状態にはOPENステータスとCLOSEステータスがあります。

案件は3つのステータスがCLOSEになったときに、作業終了とみなされます。

ステータスの表示順のまま案件の各ステータスのプルダウンに表示されますので注意ください。

- ステータスを修正すると順番は最後になります。
- 案件を手動で新規登録するとき、ステータスの順番の先頭のステータスが初期入力値になります。
- <?php echo __d('import_default', 'Import Default'); ?>でインポートする際には、<span class="label label-info"><?php echo __('Default Open Status'); ?></span> がついたステータスが初期入力されます。

- - -

#### OPENステータス

OPENステータスは、まだ作業中のステータスです。
「未着手」「著者問い合わせ中」などの状態が当てはまります。

#### 初期ステータス

初期ステータス(<span class="label label-info"><?php echo __('Default Open Status'); ?></span>を含む)は最初に登録されるステータスであり、削除できません。ただし編集は可能です

#### CLOSEステータス

CLOSEステータスは、作業完了のステータスです。
「著者許諾OK」「許諾NG」などの状態が当てはまります。
