<?php

/* webview/jobs/partials/job-staff-dropdown.twig */
class __TwigTemplate_5086719ba19fd1fd218678850db1d9c0f40eeac8f9c31ac73dc6ad7ed1c92a36 extends Twig_Template
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
        if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_type", array()) == "fixed")) {
            // line 2
            echo "<li><a href=\"";
            echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, app_lang("text_job_btn_op_give_milestone"), "html", null, true);
            echo "</a></li>
";
        }
        // line 4
        echo "<li><a href=\"";
        echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_contract"), "html", null, true);
        echo "</a></li>
<li><a href=\"";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["profile_link"]) ? $context["profile_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_profile"), "html", null, true);
        echo "</a></li>
<li><a href=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["end_contract_link"]) ? $context["end_contract_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_end_contract"), "html", null, true);
        echo "</a></li>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-staff-dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 6,  36 => 5,  29 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if job.job_type == \"fixed\" %}
<li><a href=\"{{ job_detail_link }}\">{{ app_lang('text_job_btn_op_give_milestone') }}</a></li>
{% endif %}
<li><a href=\"{{ job_detail_link }}\">{{ app_lang('text_job_btn_op_view_contract') }}</a></li>
<li><a href=\"{{ profile_link }}\">{{ app_lang('text_job_btn_op_view_profile') }}</a></li>
<li><a href=\"{{ end_contract_link }}\">{{ app_lang('text_job_btn_op_end_contract') }}</a></li>", "webview/jobs/partials/job-staff-dropdown.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-staff-dropdown.twig");
    }
}
