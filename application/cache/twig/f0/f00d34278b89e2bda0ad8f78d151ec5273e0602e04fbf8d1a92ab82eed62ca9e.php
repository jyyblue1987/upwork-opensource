<?php

/* webview/jobs/partials/job-payment-info.twig */
class __TwigTemplate_1ccfc13766236691d53c61a8b9e17f8c81befb01b6836626f66994812e5e48d8 extends Twig_Template
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
            echo "    <div class=\"col-md-4 text-center hour_info\">

        ";
            // line 4
            $context["job_id"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array());
            // line 5
            echo "        ";
            $context["fuser_id"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array());
            // line 6
            echo "        ";
            $context["total_hour"] = 0;
            // line 7
            echo "        ";
            $context["text_job_total_hour"] = "text_job_total_hour";
            // line 8
            echo "        
        ";
            // line 9
            if (((isset($context["page"]) ? $context["page"] : null) == "pasthire")) {
                // line 10
                echo "            ";
                $context["text_job_total_hour"] = "text_job_total_hour_pasthire";
                // line 11
                echo "        ";
            }
            // line 12
            echo "        
        ";
            // line 13
            if ((($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array", true, true) && $this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array", false, true), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array", true, true)) && ($this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array"), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array") > 0))) {
                // line 14
                echo "            ";
                $context["total_hour"] = $this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array"), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array");
                // line 15
                echo "            ";
                echo sprintf(app_lang((isset($context["text_job_total_hour"]) ? $context["text_job_total_hour"] : null)), (isset($context["total_hour"]) ? $context["total_hour"] : null));
                echo "
        ";
            } else {
                // line 17
                echo "            ";
                echo sprintf(app_lang((isset($context["text_job_total_hour"]) ? $context["text_job_total_hour"] : null)), "0.00");
                echo "
        ";
            }
            // line 19
            echo "
        <br />

        ";
            // line 22
            if ($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "offer_bid_amount", array())) {
                // line 23
                echo "            ";
                $context["amount"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "offer_bid_amount", array());
                // line 24
                echo "        ";
            } else {
                // line 25
                echo "            ";
                $context["amount"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_amount", array());
                // line 26
                echo "        ";
            }
            // line 27
            echo "
        @ ";
            // line 28
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_by_hours"), (isset($context["amount"]) ? $context["amount"] : null)), "html", null, true);
            echo " = <b> \$";
            echo twig_escape_filter($this->env, ((isset($context["amount"]) ? $context["amount"] : null) * (isset($context["total_hour"]) ? $context["total_hour"] : null)), "html", null, true);
            echo "</b>

        ";
            // line 31
            echo "        ";
            if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "jobstatus", array()) != "1")) {
                // line 32
                echo "        <br />
        <p style=\"margin:0 !important;\">";
                // line 33
                echo twig_escape_filter($this->env, app_lang("text_job_contract_hold"), "html", null, true);
                echo "</p>
        <hr>
        ";
            }
            // line 36
            echo "    </div>
";
        } else {
            // line 38
            echo "    <div class=\"pay_btn\">
        <div class=\"col-md-4 text-center\">
            <span>
                <b>\$";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fixedpay_amount", array()), "html", null, true);
            echo "</b> 
                ";
            // line 42
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_paid_of"), $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "hired_on", array())), "html", null, true);
            echo "
        
                ";
            // line 45
            echo "                ";
            if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "jobstatus", array()) != "1")) {
                // line 46
                echo "                <br />
                <p style=\"margin:0 !important;\">";
                // line 47
                echo twig_escape_filter($this->env, app_lang("text_job_contract_hold"), "html", null, true);
                echo "</p>
                ";
            }
            // line 49
            echo "                
            </span>
        </div>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-payment-info.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 49,  132 => 47,  129 => 46,  126 => 45,  121 => 42,  117 => 41,  112 => 38,  108 => 36,  102 => 33,  99 => 32,  96 => 31,  89 => 28,  86 => 27,  83 => 26,  80 => 25,  77 => 24,  74 => 23,  72 => 22,  67 => 19,  61 => 17,  55 => 15,  52 => 14,  50 => 13,  47 => 12,  44 => 11,  41 => 10,  39 => 9,  36 => 8,  33 => 7,  30 => 6,  27 => 5,  25 => 4,  21 => 2,  19 => 1,);
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
    <div class=\"col-md-4 text-center hour_info\">

        {% set job_id     = job.job_id %}
        {% set fuser_id   = job.fuser_id %}
        {% set total_hour = 0 %}
        {% set text_job_total_hour = 'text_job_total_hour' %}
        
        {% if page == 'pasthire' %}
            {% set text_job_total_hour = 'text_job_total_hour_pasthire' %}
        {% endif %}
        
        {% if freelancer_job_hour[ job_id ] is defined and freelancer_job_hour[ job_id ][ fuser_id] is defined and freelancer_job_hour[ job_id ][ fuser_id]  > 0 %}
            {% set total_hour = freelancer_job_hour[job_id][fuser_id] %}
            {{ app_lang(text_job_total_hour)|format( total_hour )|raw }}
        {% else %}
            {{ app_lang(text_job_total_hour)|format( '0.00' )|raw }}
        {% endif %}

        <br />

        {% if job.offer_bid_amount %}
            {% set amount   = job.offer_bid_amount %}
        {% else %}
            {% set amount   = job.bid_amount %}
        {% endif %}

        @ {{ app_lang('text_job_by_hours')|format(amount) }} = <b> \${{ amount * total_hour }}</b>

        {# hold contract text #}
        {%if job.jobstatus != '1' %}
        <br />
        <p style=\"margin:0 !important;\">{{ app_lang('text_job_contract_hold') }}</p>
        <hr>
        {% endif %}
    </div>
{% else %}
    <div class=\"pay_btn\">
        <div class=\"col-md-4 text-center\">
            <span>
                <b>\${{ job.fixedpay_amount }}</b> 
                {{ app_lang('text_job_paid_of')|format(job.hired_on) }}
        
                {# hold contract text #}
                {%if job.jobstatus != '1' %}
                <br />
                <p style=\"margin:0 !important;\">{{ app_lang('text_job_contract_hold') }}</p>
                {% endif %}
                
            </span>
        </div>
    </div>
{% endif %}
", "webview/jobs/partials/job-payment-info.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-payment-info.twig");
    }
}
