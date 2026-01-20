<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use voku\helper\HtmlDomParser;

class TemplateController extends Controller
{
    //

    public $tender_form_id = [
        'subordination' => 'subordinations',
        'knowledge_and_education_1' => [
            'add' => 'modal_tender_add_cond_doc1',
            'edit' => 'emodal_tender_add_cond_doc1'
        ],
        'professional_courses_and_trainings_2' => [
            'add' => 'modal_tender_add_cond_doc2',
            'edit' => 'emodal_tender_add_cond_doc2'
        ],
        'professional_experience_3' => [
            'add' => 'modal_tender_add_cond_doc3',
            'edit' => 'emodal_tender_add_cond_doc3'
        ],
        'additional_requirements_4' => [
            'add' => 'modal_tender_add_cond_doc4',
            'edit' => 'emodal_tender_add_cond_doc4'
        ],
    ];

    function edit(Request $request, Template $template){

        abort_if(!$template, 404);
        $isDuplicate = request()->routeIs('template.duplicate.create');
        $actionURL = $isDuplicate ? route('template.duplicate.store',$template->id) : route('template.update',$template->id);
        $download = true;
        
        return view('templates.'.$template->blade_file,compact('template','actionURL','isDuplicate'));
    }

    function view(Request $request, Template $template, $is_download = false){
        abort_if(!$template, 404);

        $template->load('tender');

        $isDuplicate = request()->routeIs('template.duplicate.create');
        $actionURL = $isDuplicate ? route('template.duplicate.store',$template->id) : route('template.update',$template->id);
        $download = true;
        
        if($is_download){

            $htmlCode = view(
                'templates.'.$template->blade_file,
                // 'templates.test',
                compact('template','actionURL','isDuplicate','download'))->render();
        }else{
            $isView = true;
            $htmlCode = view(
                'templates.'.$template->blade_file,
                // 'templates.test',
                compact('template','actionURL','isDuplicate','download','isView'))->render();

        }

        
        
        $document = HtmlDomParser::str_get_html($htmlCode);

        

        $inputValues = json_decode($template->value,true);

        foreach ($inputValues as $key => $data) {

            $ele = $document->getElementById($key);
            if($ele && $ele->getNode()){
                try {
                    if($ele->getNode()->nodeName=='input'){
                        $ele->setAttribute('value',($data['value'])) ;
                        if(!$is_download){
                            $ele->setAttribute('readonly','true');
                        }
                    }else{
                        $ele->val(nl2br($data['value']));
                        $ele->setAttribute('class', str($ele->getAttribute('class'))->remove([
                            'form-control'
                        ]));
                    }

                    $labelText = $inputValues[$key.'_label']['value'] ?? '';

                    $labelText = is_null($labelText) || $labelText =='null' ? '':$labelText;
                    
                    if($ele->prev_sibling()->prev_sibling()->childNodes(0)->getTag()=='u'){
                        $ele->prev_sibling()->prev_sibling()->children(0)->getNode()->textContent = $labelText ??'' ;
                    }else{
                        $ele->prev_sibling()->prev_sibling()->outertext = '<b>'.$labelText.'</b>' ;
                    }
                    
                    
                    
                } catch (\Throwable $th) {
                    // throw $th;
                }
            }
        }

        
                        
        $htmlCode = (string) $document;
        $headerTitle = $inputValues['header_title']['value'];

        $htmlCode = str_replace(['textarea','מכרז כ"א 24.24 למשרת נהגי.ות אוטובוס'], ['div',$headerTitle], ($htmlCode));

        return $htmlCode;
    }

    function download(Request $request, Template $template){
        
        $htmlCode = $this->view($request,$template , true);

        // return $htmlCode;


        $pdf = \Barryvdh\Snappy\Facades\SnappyPdf::loadHTML($htmlCode)->setPaper('A4')->setOrientation('portrait');

        // $pdf->setOption('enable-javascript', true);
        // $pdf->setOption('javascript-delay', 2000);
        // if($request->host()=='127.0.0.1'){
        //     $pdf->setOption('disable-smart-shrinking', true);
        // }else{
        //     $pdf->setOption('enable-smart-shrinking', true);
        // }
        // $pdf->setOption('no-stop-slow-scripts', true);
        // $pdf->setOption('enable-internal-links', true);
        // $pdf->setOption('enable-local-file-access', true);
        // $pdf->setOption('enable-external-links', true);
        // $pdf->setOption('keep-relative-links', true);
        // $pdf->setOption('resolve-relative-links', true);
        // $pdf->setOption('footer-center', true);
        // $pdf->setOption('load-error-handling','ignore');
        // $pdf->setOption('load-media-error-handling','ignore');
        $pdf->setOption('margin-top', 35);
        $pdf->setOption('encoding', 'utf-8');
        $pdf->setOption('margin-bottom', 35);
        $pdf->setOption('margin-left', 20);
        $pdf->setOption('margin-right', 20);

        
        $inputValues = json_decode($template->value,true);
        $headerTitle = $inputValues['header_title']['value'];

        $document = str(view('templates.include.header',['download' => true])->render())->replace('מכרז כ"א 24.24 למשרת נהגי.ות אוטובוס', $headerTitle);


        $pdf->setOption('header-html', (string) $document );
        $pdf->setOption('footer-html', view('templates.include.footer')->render());
        // return $pdf->inline($template->name.'.pdf');
        return $pdf->download($template->name.'.pdf');

    }

    function delete(Request $request, Template $template){
        abort_if(!$template, 404);
        Tender::where('template_id',$template->id)->update(['template_id' => null]);
        $template->delete();

        return back();
    }

    function index(Request $request){
        $pageTitle = 'Templates';
        $templates = Template::paginate(25);
        return view('templates',compact('pageTitle','templates'));
    }

    function update(Request $request,Template $template){
        $values = [];
        $tender_form_id = $this->tender_form_id;
        foreach ($request->except('_token') as $key => $data) {
            $values[$key] = [
                'value' => $data,
                'tender_form_id' => $tender_form_id[$key] ?? null,
            ];
        }
        if($template->name_of_form_name){
            $template->name = $request->{$template->name_of_form_name};
        }
        $template->value = json_encode($values);
        $template->save();

        return redirect()->back();
    }

    function duplicate(Request $request,Template $template){
        $values = [];
        $tender_form_id = $this->tender_form_id;

        foreach ($request->except('_token') as $key => $data) {
            $values[$key] = [
                'value' => $data,
                'tender_form_id' => $tender_form_id[$key] ?? null,
            ];
        }
        if($template->name_of_form_name){
            $template->name = $request->{$template->name_of_form_name};
        }
        $template->value = json_encode($values);
        
        $newTemplate = new Template();

        $newTemplate = $template->replicate();
        $newTemplate->save();

        return to_route('template.edit',$newTemplate->id);
    }
}
