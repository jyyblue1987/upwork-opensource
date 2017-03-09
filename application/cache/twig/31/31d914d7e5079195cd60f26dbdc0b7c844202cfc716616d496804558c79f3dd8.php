<?php

/* webview/jobs/partials/job-item.twig */
class __TwigTemplate_1d35c34b4593619f1d74fc3bfba3eb26398b0891f3168a0947271fdf66abf902 extends Twig_Template
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
        $context["title"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "hire_title", array());
        // line 2
        $context["job_id_encoded"] = base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array()));
        // line 3
        $context["fuser_id_encoded"] = base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array()));
        // line 4
        echo "
";
        // line 5
        if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_type", array()) == "hourly")) {
            // line 6
            echo "    
    ";
            // line 7
            $context["end_contract_link"] = ((((base_url() . "endhourlyfixed/hourly_client?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null)) . "&fuser=") . (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null));
            // line 8
            echo "    ";
            $context["job_detail_link"] = ((((base_url() . "jobs/hourly_client_view?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null)) . "&fuser") . (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null));
            // line 9
            echo "
";
        } else {
            // line 11
            echo "    
    ";
            // line 12
            $context["end_contract_link"] = ((((base_url() . "endhourlyfixed/fixed_client?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null)) . "&fuser=") . (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null));
            // line 13
            echo "    ";
            $context["job_detail_link"] = ((((base_url() . "jobs/fixed_client_view?fmJob=") . (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null)) . "&fuser=") . (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null));
            // line 14
            echo "    
";
        }
        // line 16
        echo "                
<div class=\"row margintop-2 ms_white_box\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            
            ";
        // line 21
        echo twig_include($this->env, $context, "webview/jobs/partials/job-user-info.twig");
        echo "
            
            ";
        // line 23
        echo twig_include($this->env, $context, "webview/jobs/partials/job-payment-info.twig");
        echo "
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn\">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn\"  
                                   onclick=\"loadmessage(";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_id", array()), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "user_id", array()), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array()), "html", null, true);
        echo ",'";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_fname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_lname", array()), "html", null, true);
        echo "','";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "')\" 
                                   value=\"";
        // line 32
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\">
                        </div>
                    </div>
                        
                    ";
        // line 36
        echo twig_include($this->env, $context, "webview/jobs/partials/job-payment-buttons.twig");
        echo "
                    
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                <li><a href=\"";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_give_milestone"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"#\">";
        // line 45
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_contact"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"#\">";
        // line 46
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_profile"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["end_contract_link"]) ? $context["end_contract_link"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_end_contract"), "html", null, true);
        echo "</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"job_detais\" style=\"margin-top: -10px;\">
                    <a href=\"";
        // line 57
        echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
        echo "\">  ";
        echo twig_escape_filter($this->env, app_lang("text_job_link_detail"), "html", null, true);
        echo " </a>  
                    <strong>-</strong>
                    <span><b>";
        // line 59
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</b></span>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 59,  138 => 57,  123 => 47,  119 => 46,  115 => 45,  109 => 44,  98 => 36,  91 => 32,  77 => 31,  66 => 23,  61 => 21,  54 => 16,  50 => 14,  47 => 13,  45 => 12,  42 => 11,  38 => 9,  35 => 8,  33 => 7,  30 => 6,  28 => 5,  25 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set title            = job.hire_title %}
{% set job_id_encoded   = base64_encode(job.job_id) %}
{% set fuser_id_encoded = base64_encode(job.fuser_id) %}

{% if job.job_type == \"hourly\" %}
    
    {% set end_contract_link = base_url() ~ \"endhourlyfixed/hourly_client?fmJob=\" ~ job_id_encoded ~ '&fuser=' ~ fuser_id_encoded %}
    {% set job_detail_link   = base_url() ~ \"jobs/hourly_client_view?fmJob=\" ~ job_id_encoded ~ '&fuser' ~ fuser_id_encoded %}

{% else %}
    
    {% set end_contract_link = base_url() ~ \"endhourlyfixed/fixed_client?fmJob=\" ~ job_id_encoded ~ '&fuser=' ~ fuser_id_encoded %}
    {% set job_detail_link   = base_url() ~ \"jobs/fixed_client_view?fmJob=\" ~ job_id_encoded ~ '&fuser=' ~ fuser_id_encoded %}
    
{% endif %}
                
<div class=\"row margintop-2 ms_white_box\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            
            {{ include('webview/jobs/partials/job-user-info.twig') }}
            
            {{ include('webview/jobs/partials/job-payment-info.twig') }}
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn\">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn\"  
                                   onclick=\"loadmessage({{ job.bid_id }}, {{ job.user_id }}, {{ job.fuser_id }},'{{ job.webuser_fname }} {{ job.webuser_lname }}','{{ title }}')\" 
                                   value=\"{{ app_lang('text_job_btn_message') }}\">
                        </div>
                    </div>
                        
                    {{ include('webview/jobs/partials/job-payment-buttons.twig') }}
                    
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                <li><a href=\"{{ job_detail_link }}\">{{ app_lang('text_job_btn_op_give_milestone') }}</a></li>
                                <li><a href=\"#\">{{ app_lang('text_job_btn_op_view_contact') }}</a></li>
                                <li><a href=\"#\">{{ app_lang('text_job_btn_op_view_profile') }}</a></li>
                                <li><a href=\"{{ end_contract_link }}\">{{ app_lang('text_job_btn_op_end_contract') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"job_detais\" style=\"margin-top: -10px;\">
                    <a href=\"{{ job_detail_link }}\">  {{ app_lang('text_job_link_detail') }} </a>  
                    <strong>-</strong>
                    <span><b>{{ title }}</b></span>
                </div>
            </div>
        </div>
    </div>
</div>", "webview/jobs/partials/job-item.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-item.twig");
    }
}
