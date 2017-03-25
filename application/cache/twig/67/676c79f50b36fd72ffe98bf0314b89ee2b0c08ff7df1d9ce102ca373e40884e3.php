<?php

/* webview/jobs/partials/job-winsjob-dropdown.twig */
class __TwigTemplate_fc1c895651c1d916145902597584d743323c58ee5aec533a2e614602143626d4 extends Twig_Template
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
        echo "<li><a href=\"";
        echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_contract"), "html", null, true);
        echo "</a></li>
<li><a href=\"";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["end_contract_link"]) ? $context["end_contract_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_end_contract"), "html", null, true);
        echo "</a></li>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-winsjob-dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<li><a href=\"{{ job_detail_link }}\">{{ app_lang('text_job_btn_op_view_contract') }}</a></li>
<li><a href=\"{{ end_contract_link }}\">{{ app_lang('text_job_btn_op_end_contract') }}</a></li>", "webview/jobs/partials/job-winsjob-dropdown.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-winsjob-dropdown.twig");
    }
}
