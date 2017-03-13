<?php

/* webview/jobs/partials/job-offer-dropdown.twig */
class __TwigTemplate_fee4f37d91697b45c07cad9bc4ba5a7a4a577c8072ef948ce0b87feb4223305e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<li><a href=\"#\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_offer"), "html", null, true);
        echo "</a></li>
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-offer-dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<li><a href=\"#\">{{ app_lang('text_job_btn_op_view_offer') }}</a></li>
", "webview/jobs/partials/job-offer-dropdown.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-offer-dropdown.twig");
    }
}
