<?php

/* webview/jobs/partials/job-payment-buttons.twig */
class __TwigTemplate_4439f3e9b8b8533cd9bf3cce4a90e55d6615a37250a9cb945d41dd777245960f extends Twig_Template
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
        if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_type", array()) == "hourly")) {
            // line 2
            echo "    <div class=\"ms_hr_work_diary\">
        <div class=\"mystaff_work_diary hour_btn work_diary_btn\">
            <a href=\"";
            // line 4
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "jobs/workdairy_client?fmJob=";
            echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
            echo "&fuser=";
            echo twig_escape_filter($this->env, (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null), "html", null, true);
            echo "\">
                <input style=\"margin-right: -1px;\" type=\"button\" class=\"btn btn-primary form-btn\" value=\"";
            // line 5
            echo twig_escape_filter($this->env, app_lang("text_job_btn_work_diary"), "html", null, true);
            echo "\" />
            </a>
        </div>
    </div>
";
        } else {
            // line 10
            echo "    ";
            if ( !(isset($context["freelancer"]) ? $context["freelancer"] : null)) {
                // line 11
                echo "    <div class=\"ms_pay_butt\">
        <div class=\"mystaff_pay_btnx payment_btn\">
            <input type=\"button\" class=\"btn btn-primary form-btn my-btn \" ";
                // line 14
                echo "                   value=\"";
                echo twig_escape_filter($this->env, app_lang("text_job_btn_payment"), "html", null, true);
                echo "\"
                   data-id =\"2\"
                   data-buserid=\"";
                // line 16
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "buser_id", array()), "html", null, true);
                echo "\"
                   data-fuserid=\"";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array()), "html", null, true);
                echo "\"
                   data-jobid=\"";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array()), "html", null, true);
                echo "\"
                 />
        </div>
    </div>
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-payment-buttons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 18,  58 => 17,  54 => 16,  48 => 14,  44 => 11,  41 => 10,  33 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if job.job_type == 'hourly' %}
    <div class=\"ms_hr_work_diary\">
        <div class=\"mystaff_work_diary hour_btn work_diary_btn\">
            <a href=\"{{ base_url() }}jobs/workdairy_client?fmJob={{ job_id_encoded }}&fuser={{ fuser_id_encoded }}\">
                <input style=\"margin-right: -1px;\" type=\"button\" class=\"btn btn-primary form-btn\" value=\"{{ app_lang('text_job_btn_work_diary') }}\" />
            </a>
        </div>
    </div>
{% else %}
    {% if not freelancer %}
    <div class=\"ms_pay_butt\">
        <div class=\"mystaff_pay_btnx payment_btn\">
            <input type=\"button\" class=\"btn btn-primary form-btn my-btn \" {# _job_btn_payment class to active payment button via js #}
                   value=\"{{ app_lang('text_job_btn_payment') }}\"
                   data-id =\"2\"
                   data-buserid=\"{{ job.buser_id }}\"
                   data-fuserid=\"{{ job.fuser_id }}\"
                   data-jobid=\"{{ job.job_id }}\"
                 />
        </div>
    </div>
    {% endif %}
{% endif %}", "webview/jobs/partials/job-payment-buttons.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-payment-buttons.twig");
    }
}
