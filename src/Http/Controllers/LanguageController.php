<?php

namespace Webtamizhan\Ltrans\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator; 

class LanguageController extends Controller
{
    private $style;
    function __construct()
    {
       $this->style = config('ltrans.style',"bs-4") ;
       $this->middleware('auth')->except('switchLang');
    }

    /**
     * Switch the language
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang($lang,Request $request)
    {
        foreach($this->langOption() as $all_lang):
            if($all_lang['folder'] == $lang){
                Session::put('locale', $all_lang['folder']);
                continue;
            }
        endforeach;
        return  redirect()->back();
    }

    /**
     * VIEW - Manage All Translations
     * @param Request $request
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request, $type = null)
    {
        if(!is_null($request->input('edit')))
        {
            $file = (!is_null($request->input('file')) ? $request->input('file') : 'auth.php');
            $allFiles = scandir(base_path()."/resources/lang/".$request->input('edit')."/");
            $str = File::getRequire(base_path()."/resources/lang/".$request->input('edit').'/'.$file);
            $files = array_diff($allFiles, array('.', '..'));
            $config_excludes = config("ltrans.exclude-files",["validation.php"]);
            $newFiles = array_diff($files,$config_excludes);
            $this->data = array(
                'stringLang'	=> $str,
                'lang'			=> $request->input('edit'),
                'files'			=> $newFiles ,
                'file'			=> $file ,
            );
            $template = 'edit';
        } else {
            $template = 'index';
            $this->data = [];
        }
        return view('vendor.translations.'.$this->style.'.'.$template,$this->data);
    }

    /**
     * VIEW - Add New Translation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view("vendor.translations.".$this->style.".create");
    }

    /**
     * POST - Add New Translation
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save( Request $request)
    {
        $rules = array(
            'name'		=> 'required',
            'folder'	=> 'required|alpha'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $template = base_path();
            $folder = $request->input('folder');
            if(File::exists($template."/resources/lang/".$folder) == false){
                mkdir( $template."/resources/lang/".$folder ,0777 );
            }
            $info = json_encode(array("name"=> $request->input('name'),"folder"=> $folder , "author" =>
                $request->input('author') ? $request->input('author') : "Ltrans"));
            $fp=fopen(  $template.'/resources/lang/'.$folder.'/config.json',"w+");
            fwrite($fp,$info);
            fclose($fp);
            $files = scandir( $template .'/resources/lang/en/');
            foreach($files as $f)
            {
                if($f != "." and $f != ".." and $f != 'config.json')
                {
                    copy( $template .'/resources/lang/en/'.$f, $template .'/resources/lang/'.$folder.'/'.$f);
                }
            }
            return redirect('translations');
        } else {
            return redirect('translations')
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * POST - Update Translation Phrases
     * @param Request $request
     * @return mixed
     */
    public function update( Request $request)
    {
        $template = base_path();
        $form  	= "<?php \n";
        $form .= "/**
 * Updated by webtamizhan/ltrans
 * Date: ".date("Y-m-d H:i:s")."
 */\n";
        $form 	.= "return array( \n";
        foreach($_POST as $key => $val)
        {
            if($key !='_token' && $key !='lang' && $key !='file')
            {
                if(!is_array($val))
                {
                    $form .= '"'.$key.'" => "'.strip_tags($val).'", '." \n ";

                } else {
                    $form .= '"'.$key.'" => array( '." \n ";
                    foreach($val as $k=>$v)
                    {
                        $form .= ' "'.$k.'" => "'.strip_tags($v).'", '." \n ";
                    }
                    $form .= "), \n";
                }
            }

        }
        $form .= ');';
        $lang = $request->input('lang');
        $file	= $request->input('file');
        $filename = $template .'/resources/lang/'.$lang.'/'.$file;
        $fp=fopen($filename,"w+");
        fwrite($fp,$form);
        fclose($fp);
        return redirect('translations?edit='.$lang.'&file='.$file);
    }

    /**
     * Remove Translation folder
     * @param $folder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove( $folder )
    {
        self::removeDir( base_path()."/resources/lang/".$folder);
        return redirect('translations');
    }

    /**
     * UTILITY FN - Remove dir
     * @param $dir
     */
    function removeDir($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                self::removedir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }


    function langOption()
    {
        $path = base_path() . '/resources/lang/';
        $lang = scandir($path);
        $t = array();
        foreach ($lang as $value) {
            if ($value === '.' || $value === '..' || $value == "vendor") {
                continue;
            }
            if (is_dir($path . $value)) {
                $fp = file_get_contents($path . $value . '/config.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }
        }
        return $t;
    }
}
