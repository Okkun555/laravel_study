<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Author extends Model
{
    use HasFactory, softDeletes;

    /**
     * テーブル名を紐づける
     */
//    protected $table = 't-author';

    /**
     * id以外で主キーを設定する
     */
//    protected $primaryKey = 'author_id';
    /**
     * タイムスタンプを利用しない
     */
//    public $timestamps = false;

    /**
     * name, kanaカラムの指定を可能にする（ホワイトリスト方式）
     */
    protected $fillable = [
        'name',
        'kana',
    ];

    /**
     * カラム値に対して固定の編集を加える
     */
    public function getKanaAttribute(string $value): string
    {
        // KANAカラムの値を取得時、半角カナに変換
        return mb_convert_kana($value, 'K');
    }

    public function setKanaAttribute(string $value)
    {
        // KANAカラムに登録時、全角カナに変換
        $this->attributes['kana'] = mb_convert_kana($value, "KV");
    }

    /**
     * データがない場合のみ登録を実施
     */
    public function create1(string $name)
    {
        $author = Author::where('name', $name)->first();
        if (empty($author)) {
            $author = Author::create(['name' => $name]);
        }
    }

    public function create2(string $name)
    {
        // create1と同じ処理になる
        $author = Author::firstOrCreate(['name' => $name]);
    }

    /**
     * 実際に実行されたSQLを確認する方法
     */
    private function getSQLLog()
    {
        // SQL保存を有効化する
        DB::enableQueryLog();

        // データ操作の実行
        $author = Author::find([1, 2, 4]);

        // クエリの取得
        $queries = DB::getQueryLog();

        // SQL保存を無効化
        DB::disableQueryLog();
    }
}
