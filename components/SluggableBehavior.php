<?php
namespace app\components;

use dosamigos\transliterator\TransliteratorHelper;
use yii\base\Behavior;
use yii\helpers\Inflector;
use yii\db\ActiveRecord;

class SluggableBehavior extends Behavior
{
    public $in_attribute = 'title_ru';
    public $out_attribute = 'alias';
    public $translit = true;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getSlug',
//            ActiveRecord::EVENT_BEFORE_UPDATE => 'updateSlug',
        ];
    }

    public function getSlug($event)
    {
        if ( empty( $this->owner->{$this->out_attribute} ) ) {
            $this->owner->{$this->out_attribute} = $this->generateSlug( $this->owner->{$this->in_attribute} );
        } else {
//            $this->owner->{$this->out_attribute} = $this->generateSlug( $this->owner->{$this->in_attribute} );
        }
    }
    
//    public function updateSlug($event)
//    {
//        $this->owner->{$this->out_attribute} = $this->generateSlug( $this->owner->{$this->in_attribute} );
//    }

    private function generateSlug( $slug )
    {
        $slug = $this->slugify( $slug );
        if ( $this->checkUniqueSlug( $slug ) ) {
            return $slug;
        } else {
            for ( $suffix = 2; !$this->checkUniqueSlug( $new_slug = $slug . '-' . $suffix ); $suffix++ ) {}
            return $new_slug;
        }
    }

    private function slugify( $slug )
    {
        if ( $this->translit ) {
            return Inflector::slug( TransliteratorHelper::process( $slug ), '-', true );
        } else {
            return $this->slug( $slug, '-', true );
        }
    }

    private function slug( $string, $replacement = '-', $lowercase = true )
    {
        $string = preg_replace( '/[^\p{L}\p{Nd}]+/u', $replacement, $string );
        $string = trim( $string, $replacement );
        return $lowercase ? strtolower( $string ) : $string;
    }

    private function checkUniqueSlug( $slug )
    {
        $pk = $this->owner->primaryKey();
        $pk = $pk[0];

        $condition = $this->out_attribute . ' = :out_attribute';
        $params = [ ':out_attribute' => $slug ];
        if ( !$this->owner->isNewRecord ) {
            $condition .= ' and ' . $pk . ' != :pk';
            $params[':pk'] = $this->owner->{$pk};
        }

        return !$this->owner->find()
            ->where( $condition, $params )
            ->one();
    }
}
