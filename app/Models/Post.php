<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['titulo', 'descricao', 'imagem', 'user_id'];

    public function rules() {

        return [

            'titulo'  => 'required',
            'descricao'=>'required',
            'imagem' => 'required',


        ];
    }

    public $mensages = [

        'titulo.required' => 'Título não informado.',
        'descricao.required' => 'Descrição não informado.',
        'imagem.required' => 'Imagem é obrigatório.',

    ];

    public static function getAllForIndex(){
        return self::select(
        'posts.id',
        'posts.titulo',
        'posts.descricao',
        'posts.imagem',
        'posts.total_gostei',
        'posts.total_naogostei',
        'posts.total_visualizacao',
        'posts.created_at',
        )->orderBy('id');
    }
}
