<?php

namespace HTML2PDF;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

trait HTML2PDFTrait{
	protected $HTMLToPDFConverter;
	protected $templateEngine;

	public function getHTMLToPDFConverter(){
		return $this->HTMLToPDFConverter;
	}

	public function setHTMLToPDFConverter(Core $HTMLToPDFConverter){
		$this->HTMLToPDFConverter=$HTMLToPDFConverter;
}

	public function getTemplateEngine(){
		return $this->templateEngine;
	}

	public function setTemplateEngine(EngineInterface $templateEngine){
		$this->templateEngine=$templateEngine;
	}

	public function createHTMLToPDFConverter(array $constructorArguments){
		$core=new \ReflectionClass(__NAMESPACE__.'\\Core');

		$this->setHTMLToPDFConverter($core->newInstanceArgs($constructorArguments));
	}

	public function renderHTMLTemplateToPDF($template,$parameters=[]){
		$HTMLContent=$this->templateEngine->render($template,$parameters);

		$this->HTMLToPDFConverter->writeHTML($HTMLContent);

		return $this->HTMLToPDFConverter->Output(null,true);
	}
}
