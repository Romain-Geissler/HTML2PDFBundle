<?php

namespace HTML2PDF;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

trait HTML2PDFTrait{
	protected $HTMLToPDFConfiguration;
	protected $templateEngine;

	public function getHTMLToPDFConfiguration(){
		return $this->HTMLToPDFConfiguration;
	}

	public function setHTMLToPDFConfiguration(array $HTMLToPDFConfiguration){
		$this->HTMLToPDFConfiguration=$HTMLToPDFConfiguration;
}

	public function getTemplateEngine(){
		return $this->templateEngine;
	}

	public function setTemplateEngine(EngineInterface $templateEngine){
		$this->templateEngine=$templateEngine;
	}

	public function createHTMLToPDFConverter(array $constructorArguments){
		$core=new \ReflectionClass(__NAMESPACE__.'\\Core');

		return $core->newInstanceArgs($constructorArguments);
	}

	public function renderHTMLTemplateToPDF($template,$parameters=[]){
		$HTMLContent=$this->templateEngine->render($template,$parameters);
		//html2pdf seems to be stateful, so create one instance for every rendered template.
		$HTMLToPDFConverter=$this->createHTMLToPDFConverter($this->HTMLToPDFConfiguration);

		$HTMLToPDFConverter->writeHTML($HTMLContent);

		return $HTMLToPDFConverter->Output(null,true);
	}
}
